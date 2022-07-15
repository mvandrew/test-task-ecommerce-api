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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            $table->string('name', 150)
                ->index()
                ->comment('Наименование категории товаров.');

            $table->foreignId('category_id')
                ->nullable()
                ->comment('Родительская категория товаров.')
                ->constrained();

            $table->string('vendor_url', 255)
                ->index()
                ->nullable()
                ->comment('Ссылка на сайте поставщика.');

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
        Schema::dropIfExists('categories');
    }
};
