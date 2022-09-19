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
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->string("personName");
            $table->string("personMiddleName");
            $table->string("personLastName");
            $table->boolean("status")->default(true);
            $table->enum('typeDocument', ['DNI', 'PASAPORTE','CARNET' ]);
            $table->string("document");
            $table->string("ruc")->nullable();
            $table->string("razonSocial")->nullable();
            $table->date("dob")->nullable();
            $table->string("age")->nullable();
            $table->string("email");
            $table->string("phone")->nullable(); 
            $table->string("cellPhone");
            $table->string("address")->nullable(); 
            $table->string("contactName")->nullable();
            $table->string("contactPhone")->nullable();
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
        Schema::dropIfExists('persons');
    }
};
