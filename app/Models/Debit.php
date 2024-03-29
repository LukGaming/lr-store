<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debit extends Model
{
    use HasFactory;

    protected $table = 'debit_table';

    protected $fillable = [
        'installments_quantity',
        'installment_percentage',
    ];
}
