<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyCompte extends Model
{
    use HasFactory;
    protected $fillable = [
        'transfer_id',
        'receiver_id',
        'previous_balances',
        'amounts',
        'balances',
        'fees',
    ];
}
