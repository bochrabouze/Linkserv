<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForfaitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forfaits', function (Blueprint $table) {
            $table->bigIncrements('forfait_id');
            $table->string('nom_forfait');                

            $table->string('nombreHeures_forfait'); 
            $table->string('prixLecon_forfait')->nullable();  
            $table->string('prix_forfait'); 
            $table->unsignedBigInteger('permis_id');
            $table->foreign('permis_id')->references('permis_id')->on('permis');
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
        Schema::dropIfExists('forfaits');
    }
}
