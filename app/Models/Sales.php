<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{

    protected $fillable = [
        'id',
        'serial_number',
        'quantity',
        'unity_value',
        'user_id',
        'client_id',
        'product_id',
        'payment_method_id'
    ];













}
