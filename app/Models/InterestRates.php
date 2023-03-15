<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterestRates extends Model
{
    protected $fillable = [
        'id',
        'percentage',
        'installments_number'
    ];
}
