<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permis', function (Blueprint $table) {
            $table->bigIncrements('permis_id');
            $table->string('nom_permis');    
                        
            $table->enum('vehicule', ['Auto', 'Moto','Autre'])->default("Auto");
            $table->enum('boite', ['Auto', 'Manuelle',''])->default("");

            $table->string('desc_permis')->nullable(); 

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
        Schema::dropIfExists('permis');
    }
}
