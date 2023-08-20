<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleSelectedDebit extends Model
{
    protected $table = 'sale_selected_debits'; // Specify the actual name of the pivot table

    protected $fillable = [
        'sale_id',
        'debit_table_id',
    ];


    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }


    public function debitTable()
    {
        return $this->belongsTo(DebitTable::class);
    }
}
