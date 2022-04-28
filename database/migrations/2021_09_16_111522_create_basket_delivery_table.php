<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasketDeliveryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basket_delivery', function (Blueprint $table) {
            $table->id();
            $table->uuid('n_commande');
            $table->integer('id_delivery_type');
            $table->integer('id_basket');
            $table->boolean('is_etage');
            $table->boolean('is_piece_chose');
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
        Schema::dropIfExists('basket_delivery');
    }
}
