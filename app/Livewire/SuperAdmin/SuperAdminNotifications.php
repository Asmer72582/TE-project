<?php

namespace App\Livewire\SuperAdmin;

use Livewire\Component;
use App\Models\Notifications;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Mail\UserEmail;

use App\Mail\MyTestEmail;
use Illuminate\Support\Facades\Mail;

class SuperAdminNotifications extends Component
{

    public $notifications;

    public $notification_title;
    public $notification_message;

    public $system_group_dont_delete_row = "system_group_dont_delete_row";

    public function create_notification()
    {

        $new_notification = new Notifications([
            "group_no" => $this->system_group_dont_delete_row,
            "notification_title" => $this->notification_title,
            "notification_message" => $this->notification_message,
            "super_admin_notification" => 1,
        ]);
        $new_notification->save();

        $all_groups = User::where("user_type", "instructor")->get();

        foreach ($all_groups as $group) {
            $new_notification = new Notifications([
                "group_no" => $group->group_no,
                "notification_title" => $this->notification_title,
                "notification_message" => $this->notification_message,
            ]);
            $new_notification->save();
        }
        $this->fetchNotifications();


        $this->reset();
    }



    public function fetchNotifications()
    {

        $this->notifications = Notifications::where("super_admin_notification", 1)->orderBy("created_at", "DESC")->get();

    }



    public function mount()
    {

        $this->fetchNotifications();
    }


    public function render()
    {
        return view('livewire.super-admin.super-admin-notifications');
    }
}
