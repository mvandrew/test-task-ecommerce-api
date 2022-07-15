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
        Schema::create('category_product', function (Blueprint $table) {

            $table->foreignId('category_id')
                ->comment('Категория каталога товаров.')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('product_id')
                ->comment('Товар.')
                ->constrained()
                ->onDelete('cascade');

            $table->primary(['category_id', 'product_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('category_product');
    }
};
