<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_info')->nullable();
            $table->tinyInteger('order_status')
                ->nullable()
                ->comment('0=Recibida, 1=Confirmada, 2=Enviada, 3=Entregada, 4=Anulada');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'fk_user_orders')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('direction_id')->nullable();
            $table->foreign('direction_id', 'fk_direction_orders')
                ->references('id')
                ->on('directions')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
