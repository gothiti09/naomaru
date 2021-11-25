<?php

namespace App\Console\Commands;

use App\Consts\MainConst;
use App\Models\Company;
use App\Models\Payout;
use App\Models\Payment;
use App\Models\User;
use App\Models\Visitation;
use App\Notifications\SendScheduleFix as NotificationsSendScheduleFix;
use App\Notifications\SendScheduleFixList;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Stripe\Stripe;
use Stripe\StripeClient;

// 日程調整の依頼メールを別居親、別居親代理人に送信する
// php artisan batch:send-schedule-fix
// --calculateを付与すると、入金可能、不正入金の更新とユーザごとの売上を計算
// --transferを付与すると、ユーザごとに送金
// --payoutを付与すると、ユーザごとに入金
class SendScheduleFix extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'batch:send-schedule-fix';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->sendScheduleFix();

        return 0;
    }

    private function sendScheduleFix()
    {
        Log::info('start sendScheduleFix.');
        $start_at = now()->format('Y/m/d H:i:s');

        // $visitationBycompanies = Visitation::select('company_id')->whereIn('status', [Visitation::STATUS_BEFORE_NOTIFICATION, Visitation::STATUS_TO_BE_SCHEDULED])->groupBy('company_id')->with(['family','family.users' => function($query){
        //     $query->whereIn('role', ['non_resident_parent', 'non_resident_agent']);
        // }])->get();
        $companies = Company::with(
            [
                'users' => function ($query) {
                    $query->whereIn('role', ['non_resident_parent', 'non_resident_agent']);
                },
                'visitations' => function ($query) {
                    $query->whereIn('status', [Visitation::STATUS_BEFORE_NOTIFICATION, Visitation::STATUS_TO_BE_SCHEDULED]);
                }
            ]
        )->get()->filter(function ($companies) {
            return $companies->visitations->count() > 0;
        });

        foreach ($companies as $family) {
            Notification::send($family->users, new NotificationsSendScheduleFix());
            foreach ($family->visitations as $visitation) {
                $visitation->toBeScheduled();
            }
        }
        // 管理者に通知
        $user = new User(['email' => MainConst::ADMIN_MAIL_ADDRESS]);
        $user->notify(new SendScheduleFixList($companies));
    }
}
