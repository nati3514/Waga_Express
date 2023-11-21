<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class package extends Model
{
    use HasFactory;
    protected $fillable = [
        'package_tag','package_type','sender_ID','receiver_ID','status','from_branch_id','to_branch_id','weight'
    ];
}
