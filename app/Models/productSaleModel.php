<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductSaleModel extends Model
{
    protected $fillable = [
        'product_id',
        'serial_numbers',
        'unity_value',
        'quantity',
        'sale_id',
    ];

    protected $table = 'product_sales';

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sales::class);
    }



}
