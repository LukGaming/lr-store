<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    public function payment_method(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
