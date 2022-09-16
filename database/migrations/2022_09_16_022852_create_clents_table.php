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
        Schema::create('clients', function (Blueprint $table) {
            $table->unsignedBigInteger('idClient');
            $table->string('code');
            $table->date('startDate');
            $table->integer('point');
            $table->integer('numberVisits');
            $table->boolean("isPensionista")->default(false);
            $table->float("pricePensionista")->nullable();
            $table->boolean("isActive")->default(false);
            $table->boolean("status")->default(false);
            $table->timestamps();

            $table->foreign('idClient')->references('id')->on('persons');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
};
