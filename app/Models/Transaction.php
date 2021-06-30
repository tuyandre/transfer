<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'transfer_id',
        'agent_id',
        'receiver_id',
        'previous_balances',
        'amounts',
        'balances',
        'fees',
    ];
    public function Transfer()
    {
        return $this->belongsTo('App\Models\User','transfer_id');
    }
    public function Receiver()
    {
        return $this->belongsTo('App\Models\User','receiver_id');
    }
}
