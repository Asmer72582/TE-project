<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repositories extends Model
{
    use HasFactory;

    protected $primaryKey = "ff_id";


    protected $fillable = [
        "ff_id",
        "group_no",
        "is_folder",
        "sub_ff_of",
        "file_path",
        "ff_title",
        "file_size"
    ];

}
