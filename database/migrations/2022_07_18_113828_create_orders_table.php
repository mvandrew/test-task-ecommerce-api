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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->index()
                ->nullable()
                ->comment('Владелец заказа.')
                ->constrained();

            $table->string('phone', 50)
                ->index()
                ->nullable()
                ->comment('Номер телефона покупателя.');

            $table->string('email', 255)
                ->index()
                ->nullable()
                ->comment('Адрес электронной почты для уведомлений по заказу.');

            $table->text('address')
                ->nullable()
                ->comment('Адрес доставки.');

            $table->text('customer_comment')
                ->nullable()
                ->comment('Комментарий покупателя к заказу.');

            $table->text('manager_comment')
                ->nullable()
                ->comment('Комментарий менеджера к заказу.');

            $table->unsignedInteger('status')
                ->default(0)
                ->index()
                ->comment('Статус заказа.');

            $table->decimal('sum_amount', 10, 2, true)
                ->nullable()
                ->comment('Сумма заказа.');

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
        Schema::dropIfExists('orders');
    }
};
