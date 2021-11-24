<?php

namespace App\Models;

use App\Notifications\CancelVisitation;
use App\Notifications\EndVisitation;
use App\Notifications\FixScheduleVisitation;
use App\Notifications\ReportVisitation;
use App\Notifications\StartVisitation;
use App\Notifications\ToBeScheduleVisitation;
use App\Scopes\FamilyScope;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class Visitation extends \App\Models\generated\Visitation
{
    protected static function booted()
    {
        static::addGlobalScope(new FamilyScope);
    }

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // newした時に自動的にuuidを設定する。
        $this->attributes['uuid'] = Str::uuid();
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    protected $dates = [
        'possible_start_1_at',
        'possible_start_2_at',
        'possible_start_3_at',
        'possible_end_1_at',
        'possible_end_2_at',
        'possible_end_3_at',
        'scheduled_start_at',
        'scheduled_end_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    const STATUS_BEFORE_NOTIFICATION = 'BEFORE_NOTIFICATION';
    const STATUS_TO_BE_SCHEDULED = 'TO_BE_SCHEDULED';
    const STATUS_SCHEDULE_FIX = 'SCHEDULE_FIX';
    const STATUS_START = 'START';
    const STATUS_END = 'END';
    const STATUS_REPORT = 'REPORT';
    const STATUS_CANCEL = 'CANCEL';
    const STATUS_LIST = [
        self::STATUS_BEFORE_NOTIFICATION => [
            'text' => '翌朝メール通知予定',
            'color' => 'gray',
        ],
        self::STATUS_TO_BE_SCHEDULED => [
            'text' => '日程調整中',
            'color' => 'red',
        ],
        self::STATUS_SCHEDULE_FIX => [
            'text' => '確定',
            'color' => 'green',
        ],
        self::STATUS_START => [
            'text' => '実施中',
            'color' => 'blue',
        ],
        self::STATUS_END => [
            'text' => '実施完了・完了報告前',
            'color' => 'gray',
        ],
        self::STATUS_REPORT => [
            'text' => '完了',
            'color' => 'gray',
        ],
        self::STATUS_CANCEL => [
            'text' => 'キャンセル',
            'color' => 'gray',
        ],
    ];

    public function canEditBeforeScheduleFix()
    {
        return Auth::user()->isResidentRole() && !$this->scheduled_at ? true : false;
    }

    public function isBeforeNotification()
    {
        return $this->status === Self::STATUS_BEFORE_NOTIFICATION;
    }

    public function isToBeScheduled()
    {
        return $this->status === Self::STATUS_TO_BE_SCHEDULED;
    }

    public function isScheduleFix()
    {
        return $this->status === Self::STATUS_SCHEDULE_FIX;
    }

    public function isStart()
    {
        return $this->status === Self::STATUS_START;
    }

    public function isEnd()
    {
        return $this->status === Self::STATUS_END;
    }

    public function isReport()
    {
        return $this->status === Self::STATUS_REPORT;
    }

    public function isCancel()
    {
        return $this->status === Self::STATUS_CANCEL;
    }

    public function finishScheduleFix()
    {
        return (bool)$this->scheduled_at;
    }

    public function isEditableFixSchedule()
    {
        return Auth::user()->isNonResidentRole() && $this->isToBeScheduled() ? true : false;
    }

    public function visbleScheduledTime(): bool
    {
        if ($this->isCancel()) {
            return false;
        }

        if (Auth::user()->isNonResidentRole()) {
            return true;
        }

        if (Auth::user()->isResidentRole() && $this->scheduled_start_at) {
            return true;
        }

        return false;
    }

    public function visbleOnEdit($value): bool
    {
        if (!$this->exists) {
            // データ自体がない場合は新規登録なので表示する。
            return true;
        }

        if ($this->exists && $value) {
            // データ自体がある場合は更新で、かつデータが有れば表示する。
            return true;
        }
        return false;
    }

    public static function createByRequest($request)
    {
        // バッチは使わずに即時で別居親にメールする仕様としている。
        $visitation = self::create($request->all() + [
            'uuid' => Str::uuid(),
            'company_id' => Auth::user()->company_id,
            'status' => Visitation::STATUS_TO_BE_SCHEDULED,
            'to_be_scheduled_at' => now(),
        ]);
        Notification::send(User::getNonResidentRoleUsers(), new ToBeScheduleVisitation($visitation));
    }

    public function toBeScheduled()
    {
        // バッチは使わずに即時で別居親にメールする仕様としているのでこのメソッドは使わない予定
        $this->fill([
            'status' => self::STATUS_TO_BE_SCHEDULED,
            'to_be_scheduled_at' => now(),
        ])->save();
    }

    public function fixSchedule($request)
    {
        $scheduled_end_at = Carbon::parse($request->scheduled_start_at)->addHour($this->hour);
        $this->fill($request->all() + [
            'scheduled_start_at' => $request->scheduled_start_at,
            'scheduled_end_at' => $scheduled_end_at,
            'scheduled_at' => now(),
            'status' => self::STATUS_SCHEDULE_FIX
        ])->save();
        Notification::send(User::getResidentRoleUsers(), new FixScheduleVisitation($this));
    }

    public function cancel($cancel_reason)
    {
        $this->fill([
            'status' => Self::STATUS_CANCEL,
            'cancel_at' => now(),
            'cancel_reason' => $cancel_reason,
        ])->save();
        Notification::send(User::getResidentRoleUsers(), new CancelVisitation($this, $cancel_reason));
    }

    public function start()
    {
        $this->fill([
            'start_at' => now(),
            'status' => self::STATUS_START
        ])->save();
        Notification::send(User::getResidentRoleUsers(), new StartVisitation($this));
    }

    public function end()
    {
        $this->fill([
            'end_at' => now(),
            'status' => self::STATUS_END
        ])->save();
        Notification::send(User::getResidentRoleUsers(), new EndVisitation($this));
    }

    public function report($request)
    {
        $this->fill($request->only(['comply', 'comply_description', 'report_description']) + [
            'report_at' => now(),
            'status' => self::STATUS_REPORT
        ])->save();
        Notification::send(User::getResidentRoleUsers(), new ReportVisitation($this));
    }

    public static function latest()
    {
        $result = self::orderByRaw('scheduled_start_at ASC')
            ->whereIn('status', [self::STATUS_SCHEDULE_FIX, self::STATUS_START])
            ->first();
        return $result;
    }

    public static function list()
    {
        $query = self::orderByRaw('scheduled_start_at IS NULL DESC, scheduled_start_at DESC');
        if (Auth::user()->isNonResidentRole()) {
            $query = $query->where('status', '<>', self::STATUS_BEFORE_NOTIFICATION);
        }
        return $query->get();
    }
}
