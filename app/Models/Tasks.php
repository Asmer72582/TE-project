<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;

    protected $primaryKey = "task_id";

    protected $fillable = [
        "task_id",
        "task_title",
        "week_no",
        "task_remark",
        "task_due_date",
        "task_completed_date",
        "group_no",
        "task_status",
        "task_folder"
    ];

}
