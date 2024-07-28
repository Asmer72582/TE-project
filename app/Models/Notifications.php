<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;

    protected $primaryKey = "notification_id";

    protected $fillable = [
        "notification_id",
        "group_no",
        "notification_title",
        "notification_message",
        "super_admin_notification"
    ];

}
