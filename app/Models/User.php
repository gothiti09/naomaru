<?php

namespace App\Models;

use App\Models\Family;
use App\Notifications\CreateUser;
use App\Scopes\FamilyScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class User extends \App\Models\generated\User
{
    // userにAuthを使ったグローバルスコープは動作しないので、必ずcompany_idを条件に付与すること

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // newした時に自動的にuuidを設定する。
        $this->attributes['uuid'] = Str::uuid();
    }

    const ROLE_RESIDENT_PARENT = 'RESIDENT_PARENT';
    const ROLE_RESIDENT_AGENT = 'RESIDENT_AGENT';
    const ROLE_NON_RESIDENT_PARENT = 'NON_RESIDENT_PARENT';
    const ROLE_NON_RESIDENT_AGENT = 'NON_RESIDENT_AGENT';
    const ROLE_CHILD = 'CHILD';

    const ROLE_LIST = [
        self::ROLE_RESIDENT_PARENT => '同居親',
        self::ROLE_RESIDENT_AGENT => '同居親代理人',
        self::ROLE_NON_RESIDENT_PARENT => '別居親',
        self::ROLE_NON_RESIDENT_AGENT => '別居親代理人',
        self::ROLE_CHILD => 'こども',
    ];

    const ROLE_LIST_HAHAOYA = [
        self::ROLE_RESIDENT_PARENT => '母親',
        self::ROLE_RESIDENT_AGENT => '母親代理人',
        self::ROLE_NON_RESIDENT_PARENT => '父親',
        self::ROLE_NON_RESIDENT_AGENT => '父親代理人',
        self::ROLE_CHILD => 'こども',
    ];

    const ROLE_LIST_TITIOYA = [
        self::ROLE_RESIDENT_PARENT => '父親',
        self::ROLE_RESIDENT_AGENT => '父親代理人',
        self::ROLE_NON_RESIDENT_PARENT => '母親',
        self::ROLE_NON_RESIDENT_AGENT => '母親代理人',
        self::ROLE_CHILD => 'こども',
    ];

    public function roleLabel()
    {
        if ($this->family->parentLabelIsHahaoya()) {
            return self::ROLE_LIST_HAHAOYA[$this->role];
        } elseif ($this->family->parentLabelIsTitioya()) {
            return self::ROLE_LIST_TITIOYA[$this->role];
        }
        return self::ROLE_LIST[$this->role];
    }

    public function residentParentLabel()
    {
        if ($this->family->parentLabelIsHahaoya()) {
            return self::ROLE_LIST_HAHAOYA[self::ROLE_RESIDENT_PARENT];
        } elseif ($this->family->parentLabelIsTitioya()) {
            return self::ROLE_LIST_TITIOYA[self::ROLE_RESIDENT_PARENT];
        }
        return self::ROLE_LIST[self::ROLE_RESIDENT_PARENT];
    }

    public function nonResidentParentLabel()
    {
        if ($this->family->parentLabelIsHahaoya()) {
            return self::ROLE_LIST_HAHAOYA[self::ROLE_NON_RESIDENT_PARENT];
        } elseif ($this->family->parentLabelIsTitioya()) {
            return self::ROLE_LIST_TITIOYA[self::ROLE_NON_RESIDENT_PARENT];
        }
        return self::ROLE_LIST[self::ROLE_NON_RESIDENT_PARENT];
    }

    public function residentAgentLabel()
    {
        if ($this->family->parentLabelIsHahaoya()) {
            return self::ROLE_LIST_HAHAOYA[self::ROLE_RESIDENT_AGENT];
        } elseif ($this->family->parentLabelIsTitioya()) {
            return self::ROLE_LIST_TITIOYA[self::ROLE_RESIDENT_AGENT];
        }
        return self::ROLE_LIST[self::ROLE_RESIDENT_AGENT];
    }

    public function isResidentRole()
    {
        return $this->role === self::ROLE_RESIDENT_PARENT || $this->role === self::ROLE_RESIDENT_AGENT || $this->role === self::ROLE_CHILD;
    }

    public function isNonResidentRole()
    {
        return $this->role === self::ROLE_NON_RESIDENT_PARENT || $this->role === self::ROLE_NON_RESIDENT_AGENT;
    }

    public function isResidentParent()
    {
        return $this->role === self::ROLE_RESIDENT_PARENT;
    }

    public function isResidentAgent()
    {
        return $this->role === self::ROLE_RESIDENT_AGENT;
    }

    public function isNonResidentParent()
    {
        return $this->role === self::ROLE_NON_RESIDENT_PARENT;
    }

    public function isNonResidentAgent()
    {
        return $this->role === self::ROLE_NON_RESIDENT_AGENT;
    }

    public function isChild()
    {
        return $this->role === self::ROLE_CHILD;
    }

    public function updateByRequest($request)
    {
        $this->fill($request->only([
            'email',
            'name',
            'kana',
            'prefecture_code',
            'tel',
            'age_range',
            'sex',
            'alert_schedule',
            'alert_action',
            'alert_report',
            'alert_message',
            'read_report',
            'read_message',
            'finish_onboarding_at',
        ]))->save();
    }

    public function resendCreateUserMail()
    {
        $password = Str::random(16);
        $hash_password = Hash::make($password);
        $this->fill(['password' => $hash_password])->save();
        $this->notify(new CreateUser($this, $password));
    }

    public static function createByRequest($request, $role)
    {
        $password = Str::random(16);
        $hash_password = Hash::make($password);
        $user = self::create($request->only([
            'email',
            'name',
            'kana',
            'prefecture_code',
            'tel',
            'age_range',
            'sex',
            'alert_schedule',
            'alert_action',
            'alert_report',
            'alert_message',
            'read_report',
            'read_message',
        ]) + [
            'company_id' => Auth::user()->company_id,
            'role' => $role,
            'password' => $hash_password,
            'email_verified_at' => now(),
        ]);

        if ($role === self::ROLE_RESIDENT_PARENT) {
            Family::find(Auth::user()->company_id)->fill(['set_resident_parent_at' => now()])->save();
        } elseif ($role === self::ROLE_RESIDENT_AGENT) {
            Family::find(Auth::user()->company_id)->fill(['set_resident_agent_at' => now()])->save();
        } elseif ($role === self::ROLE_NON_RESIDENT_PARENT) {
            Family::find(Auth::user()->company_id)->fill(['inviting_non_resident_parent_at' => now()])->save();
        } elseif ($role === self::ROLE_NON_RESIDENT_AGENT) {
            Family::find(Auth::user()->company_id)->fill(['set_non_resident_agent_at' => now()])->save();
        } elseif ($role === self::ROLE_CHILD) {
            Family::find(Auth::user()->company_id)->fill(['set_child_at' => now()])->save();
        }
        $user->notify(new CreateUser($user, $password));
    }

    public static function getResidentRoleUsers()
    {
        return Self::myFamily()
            ->whereIn('role', [User::ROLE_RESIDENT_PARENT, User::ROLE_RESIDENT_AGENT])
            ->get();
    }

    public static function getNonResidentRoleUsers()
    {
        return Self::myFamily()
            ->whereIn('role', [User::ROLE_NON_RESIDENT_PARENT, User::ROLE_NON_RESIDENT_AGENT])
            ->get();
    }

    public static function getAlertMessageUsers()
    {
        return Self::whereAlertMessage(true)
            ->where('id', '<>', Auth::id())
            ->myFamily()
            ->get();
    }

    public static function getResidentParent()
    {
        return Self::myFamily()
            ->whereRole(User::ROLE_RESIDENT_PARENT)
            ->firstOrNew();
    }

    public static function getResidentAgent()
    {
        return Self::myFamily()
            ->whereRole(User::ROLE_RESIDENT_AGENT)
            ->firstOrNew();
    }

    public static function getNonResidentParent()
    {
        return Self::myFamily()
            ->whereRole(User::ROLE_NON_RESIDENT_PARENT)
            ->firstOrNew();
    }

    public function scopeMyFamily(Builder $query)
    {
        return $query->whereFamilyId(Auth::user()->company_id);
    }
}
