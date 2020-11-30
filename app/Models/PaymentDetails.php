<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'card_type',
        'card_no',
        'postal_code',
        'country',
    ];
}
