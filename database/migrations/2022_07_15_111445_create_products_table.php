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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('name', 255)
                ->index()
                ->comment('Наименование товара.');

            $table->string('sku', 100)
                ->index()
                ->nullable()
                ->comment('Артикул.');

            $table->string('vendor_id', 32)
                ->index()
                ->nullable()
                ->comment('ИД поставщика.');

            $table->text('vendor_url')
                ->nullable()
                ->comment('Ссылка на сайте поставщика.');

            $table->decimal('price', 10, 2, true)
                ->index()
                ->nullable()
                ->comment('Цена за единицу товара.');

            $table->integer('stock')
                ->index()
                ->default(0)
                ->comment('Остаток товара на складе.');

            $table->boolean('in_stock')
                ->default(false)
                ->comment('Флаг наличия товара на складе.');

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
        Schema::dropIfExists('products');
    }
};
