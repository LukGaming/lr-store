<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('product_sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->json('serial_numbers');
            $table->decimal('unity_value', 8, 2);
            $table->integer('quantity');
            $table->unsignedBigInteger('sale_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('sale_id')->references('id')->on('sales');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_sales');
    }
};
