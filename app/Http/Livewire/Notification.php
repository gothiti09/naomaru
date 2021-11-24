<?php

namespace App\Http\Livewire;

use App\Models\Question as ModelsQuestion;
use App\Models\User;
use App\Notifications\CreateQuestion;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Notification extends Component
{
    public $unreadNotifications;
    public $notifications;
    public function render()
    {
        $this->unreadNotifications = Auth::user()->unreadNotifications;
        $this->notifications = Auth::user()->notifications;
        return view('livewire.notification');
    }

    public function read($uuid)
    {
        $notification = Auth::user()->notifications->where('uuid', $uuid)->first();
        $notification->markAsRead(10);
        return redirect($notification->data['url']);
    }
}
