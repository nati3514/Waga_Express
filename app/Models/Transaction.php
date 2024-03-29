<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'branch_id_fk', 'package_id_fk','user_id_fk', 'status','percent','price','Ded_amount','commission', 'current_balance'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id_fk');
    }
   
}
