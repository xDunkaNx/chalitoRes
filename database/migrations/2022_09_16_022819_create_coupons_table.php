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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idClient')->nullable();
            $table->string("code");
            $table->string("couponName");
            $table->date("startDate");
            $table->date("endDate");
            $table->boolean("main")->default(false);
            $table->boolean("allDays")->default(false);
            $table->date("days");
            $table->float("condition"); //(Monto para ser impreso en una compra para el cliente o ver la manera de generar por compra de unos productos seleccionados)
            $table->boolean("status")->default(false);
            $table->timestamps();

            $table->foreign('idClient')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
};
