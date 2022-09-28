<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->bigIncrements('application_id');
            $table->unsignedBigInteger('applicant_id');
            $table->foreign('applicant_id')->references('applicant_id')->on('applicants');
            $table->timestamps();
            $table->string('Description')->nullable(); 
            $table->enum('Categorie', ['Plumbing ',' Carpentry ',' Gardening ',' Hotel ',' Catering ',' Secretariat ',' Transport ',' Delivery ',' Engineering ',' Technicians', 'Electricity', 'Mechanics',' Industry ' ]);
            $table->date('Date')->nullable();
            $table->string('Wage')->nullable();
            $table->string('Workers')->nullable();
            $table->enum('State', ['In progress','Finished','Canceled']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
}
