<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AcmeTablesMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('document_number')->unique();
            $table->string('address');
            $table->string('phone_number');
            $table->string('city');
            $table->timestamps();
        });

        Schema::create('drivers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('document_number')->unique();
            $table->string('address');
            $table->string('phone_number');
            $table->enum('license_type', ['c1', 'b1']);
            $table->string('city');
            $table->timestamps();
        });

        Schema::create('brands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('vehicles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('plate')->unique();
            $table->string('color');
            $table->bigInteger('brand_id')->unsigned();
            $table->enum('type', ['public', 'private']);
            $table->bigInteger('owner_id')->unsigned();
            $table->bigInteger('driver_id')->unsigned();
            $table->timestamps();

            $table->foreign('brand_id')->references('id')->on('brands');
            $table->foreign('driver_id')->references('id')->on('drivers');
            $table->foreign('owner_id')->references('id')->on('owners');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
        Schema::dropIfExists('brands');
        Schema::dropIfExists('drivers');
        Schema::dropIfExists('owners');
    }
}
