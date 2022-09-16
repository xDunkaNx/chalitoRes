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
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idOffice');
            $table->string("tableName");
            $table->string("tableShortName");
            $table->string("numberFlat");
            $table->string("occupied");
            $table->boolean("isActive")->default(true);
            $table->boolean("status")->default(true);
            $table->timestamps();

            $table->foreign('idOffice')->references('id')->on('offices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tables');
    }
};
