<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sales extends Model
{
    protected $fillable = [
        'id',
        'sale_date',
        'sale_type',
        'user_id',
        'client_id',
        'payment_method',
    ];

    public function productSales(): HasMany
    {
        return $this->hasMany(ProductSale::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }



    public function creditTables()
    {
        return $this->belongsToMany(CreditTable::class, 'sale_credit_table');
    }
}
