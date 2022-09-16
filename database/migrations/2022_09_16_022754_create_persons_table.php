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
            $table->boolean("status")->default(false);
            $table->enum('typeDocument', ['DNI', 'PASAPORTE','CARNET' ]);
            $table->string("document");
            $table->string("ruc")->nullable();
            $table->string("razonSocial")->nullable();
            $table->date("dob");
            $table->string("age")->nullable();
            $table->string("email")->nullable();
            $table->string("phone")->nullable(); 
            $table->string("cellPhone")->nullable();
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
