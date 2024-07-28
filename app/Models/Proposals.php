<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposals extends Model
{
    use HasFactory;

    protected $primaryKey = "proposal_id";

    protected $fillable = [
        "proposal_id",
        "group_no",
        "proposal_name",
        "proposal_description",
        "proposal_domain",
        "is_accepted",
        "student"
    ];


}
