<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            //$table->bigIncrements('id');
            $table->uuid('uuid');
            $table->primary('uuid');
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('street')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('cellular_number')->nullable();
            $table->string('neighborhood')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
