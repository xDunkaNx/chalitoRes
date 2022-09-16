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
        Schema::create('offices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idCity');
            $table->unsignedBigInteger('idManager');
            $table->string("officeName");
            $table->string("address");
            $table->string("phone")->nullable();
            $table->string("cellPhone");
            $table->boolean("isRestaurant")->default(false);
            $table->boolean("isMain")->default(false);
            $table->string("ubigeo")->nullable();
            $table->string("latitude")->nullable();
            $table->string("longitude")->nullable();
            $table->timestamps();

            $table->foreign('idCity')->references('id')->on('categories');
            $table->foreign('idManager')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offices');
    }
};
