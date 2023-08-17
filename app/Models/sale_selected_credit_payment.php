<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sale_selected_credit_payment extends Model
{
    protected $table = 'sale_selected_credit_payments'; // Specify the actual name of the pivot table

    protected $fillable = [
        'sale_id',
        'credit_table_id',
    ];


    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }


    public function creditTable()
    {
        return $this->belongsTo(CreditTable::class);
    }
}
