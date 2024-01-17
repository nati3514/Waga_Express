<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffTransaction extends Model
{
    use HasFactory;
    protected $fillable = ['branch_id', 'bank_name', 'deposit_amount', 'date', 'reference_num', 'image'];
}
