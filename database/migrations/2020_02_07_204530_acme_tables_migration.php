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

        Schema::create('vehicles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('plate');
            $table->string('color');
            $table->string('brand');
            $table->enum('type', ['public', 'private']);
            $table->bigInteger('owner_id');
            $table->bigInteger('driver_id');
            $table->timestamps();
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
        Schema::dropIfExists('drivers');
        Schema::dropIfExists('owners');
    }
}
