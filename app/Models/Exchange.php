<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'user_id', 'exchange_type', 'status', 'amount_exchanged', 'amount_received', 'date', 'status'];
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
