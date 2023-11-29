<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'branch_id_fk', 'package_id_fk', 'percent','price','Ded_amount','commission'
    ];

   
}
