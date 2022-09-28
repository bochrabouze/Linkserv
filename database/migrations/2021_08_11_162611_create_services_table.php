<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('service_id');
            $table->unsignedBigInteger('servant_id');
            $table->foreign('servant_id')->references('servant_id')->on('servants');
            $table->unsignedBigInteger('application_id');
            $table->foreign('application_id')->references('application_id')->on('applications');
            $table->timestamps();
            $table->string('Description')->nullable(); 
            $table->enum('State', ['In progress', 'Accept','Refuse']);
            $table->string('Date')->nullable();
            $table->string('Wage')->nullable();

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
