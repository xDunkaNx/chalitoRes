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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idTable');
            // $table->unsignedBigInteger('idMozo');
            $table->string("idMozo");
            $table->unsignedBigInteger('idClient');
            $table->unsignedBigInteger('idCupon');
            $table->unsignedBigInteger('idPromotion');
            $table->unsignedBigInteger('idSerie');
            $table->date("date");
            $table->float("realAmount");
            $table->float("descuento");
            $table->string("tag");
            $table->float("amountTag");
            $table->float("amouintWithTag");
            $table->float("amountWithoutTag");
            $table->float("amountTotal");
            $table->float("discount")->nullable();
            $table->string("serie");
            $table->string("correlative");
            $table->timestamps();

            $table->foreign('idTable')->references('id')->on('tables');
            // $table->foreign('idMozo')->references('id')->on('users');
            $table->foreign('idClient')->references('id')->on('persons');
            $table->foreign('idCupon')->references('id')->on('coupons');
            $table->foreign('idPromotion')->references('id')->on('promotions');
            $table->foreign('idSerie')->references('id')->on('series');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
};
