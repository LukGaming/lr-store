<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = ['id', 'name', 'manufacture_id'];

    public function manufecturer(): BelongsTo
    {
        return $this->belongsTo(Manufacturer::class);
    }
}
