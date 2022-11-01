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
        Schema::create('order_sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idTable');
            // $table->unsignedBigInteger('idMozo');
            $table->string("idMozo");
            $table->date("date");
            $table->float("amountTotal");
            $table->boolean("status")->default(true);
            $table->timestamps();

            $table->foreign('idTable')->references('id')->on('tables');
            // $table->foreign('idMozo')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_sales');
    }
};
