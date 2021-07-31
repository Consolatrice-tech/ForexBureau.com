<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = ['sender_Names', 'sender_Phone', 'receiver_Names', 'receiver_Location', 'Transaction_type', 'amount', 'currency', 'date'];
}
