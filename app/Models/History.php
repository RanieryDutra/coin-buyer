<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $table = 'quote_history';
    protected $fillable = [
        'id_usuario',
        'origin_currency',
        'destination_currency',
        'value_for_conversion',
        'form_of_payment',
        'value_of_the_quoted_currency',
        'purchased_value_of_quoted_currency',
        'payment_rate',
        'conversion_rate',
        'total_value_excluding_rates',
        'conversion_data'
    ];
}
