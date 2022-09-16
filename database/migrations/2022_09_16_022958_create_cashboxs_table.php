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
        Schema::create('cashboxs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idUser');
            $table->unsignedBigInteger('idAdmin');
            $table->float("amountInitial");
            $table->date("openDate");
            $table->date("closeDate")->nullable();
            $table->boolean("isActive")->default(true);
            $table->boolean("status")->default(true);
            $table->timestamps();

            $table->foreign('idUser')->references('id')->on('users');
            $table->foreign('idAdmin')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cashboxs');
    }
};
