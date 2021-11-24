<?php

namespace App\Models;

use App\Notifications\CreateMessage;
use App\Notifications\ReplyMessage;
use App\Scopes\FamilyScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class Message extends \App\Models\generated\Message
{
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

    protected static function booted()
    {
        static::addGlobalScope(new FamilyScope);
    }
    public static function list()
    {
        $query = self::orderBy('id', 'desc');
        return $query->get();
    }

    public static function createByRequest($request)
    {
        $message = Message::create($request->only(['message']) + ['message_by' => Auth::id()]);
        Notification::send(User::getAlertMessageUsers(), new CreateMessage($message, Auth::user()));
    }

    public function updateByRequest($request)
    {
        $this->fill($request->only(['reply']) + ['reply_by' => Auth::id()])->save();
        Notification::send(User::getAlertMessageUsers(), new ReplyMessage($this, Auth::user()));
    }
}
