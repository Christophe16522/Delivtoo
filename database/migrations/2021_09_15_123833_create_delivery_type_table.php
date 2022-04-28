<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_type', function (Blueprint $table) {
            $table->id();
            $table->string('nom_delivery_type');
            $table->double('prix_ttc_delivery');
            $table->double('prix_ttc_delivery_etage');
            $table->double('prix_ttc_delivery_choix_piece');
            $table->boolean('have_delivery_etage');
            $table->boolean('have_delivery_choix_piece');
            $table->double('longeur_cm');
            $table->double('largeur_cm');
            $table->double('hauteur_cm');
            $table->double('poids_kg');
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
        Schema::dropIfExists('delivery_type');
    }
}
