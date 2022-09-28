<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->string('name')->default("");           
            $table->string('email',191)->unique();              
            $table->enum('type_user', ['applicant', 'servant'])->default('servant');
            $table->enum('etat_user', ['Actif', 'Bloque'])->default("Actif");
            $table->timestamp('email_verified_at')->nullable();
            $table->string('adress')->default("");
            $table->string('password');
            $table->string('Tel')->default("");
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
