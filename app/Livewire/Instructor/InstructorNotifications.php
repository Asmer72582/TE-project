<?php

namespace App\Livewire\Instructor;

use Livewire\Component;
use App\Models\Notifications;
use Illuminate\Support\Facades\Auth;

class InstructorNotifications extends Component
{

    public $notifications;

    public $notification_title;
    public $notification_message;

    public function create_notification()
    {

        $new_notification = new Notifications([
            "group_no" => Auth::user()->group_no,
            "notification_title" => $this->notification_title,
            "notification_message" => $this->notification_message
        ]);
        $new_notification->save();
        $this->reset();
        $this->fetchNotifications();
    }

    public function fetchNotifications()
    {
        $this->notifications = Notifications::where("group_no", Auth::user()->group_no)->orderBy("created_at", "DESC")->get();
    }

    public function mount()
    {
        $this->fetchNotifications();
    }

    public function render()
    {
        return view('livewire.instructor.instructor-notifications');
    }
}
