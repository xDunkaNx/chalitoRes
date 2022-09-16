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
        Schema::create('presentations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idProduct');
            $table->string('code');
            $table->string("presentationName");
            $table->string("presentationShortName");
            $table->string("description");
            $table->float("precio");
            $table->boolean("isActive")->default(false);
            $table->boolean("status")->default(false);
            $table->timestamps();
            
            $table->foreign('idProduct')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('presentations');
    }
};
