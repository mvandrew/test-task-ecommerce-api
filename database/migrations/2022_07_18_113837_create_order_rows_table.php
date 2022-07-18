<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('order_rows', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')
                ->comment('Заказ покупателя.')
                ->constrained();

            $table->foreignId('product_id')
                ->comment('Товар.')
                ->constrained();

            $table->unsignedInteger('qty')
                ->comment('Заказанное количество.');

            $table->decimal('price', 10, 2, true)
                ->index()
                ->comment('Цена за единицу товара.');

            $table->decimal('amount', 10, 2, true)
                ->index()
                ->comment('Сумма заказа по строке.');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('order_rows');
    }
};
