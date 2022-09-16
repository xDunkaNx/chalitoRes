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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idCategory');
            $table->enum('group', ['COMIDA', 'BEBIDA','POSTRE' ]);
            $table->string("code");
            $table->string("productName");
            $table->string("productShortName");
            $table->string("description");
            $table->string("whitPresentation")->nullable();
            $table->boolean("isCombo")->default(false);
            $table->string("image");
            $table->float("precio");
            $table->boolean("isActive")->default(true);
            $table->boolean("status")->default(true);
            $table->timestamps();

            $table->foreign('idCategory')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
