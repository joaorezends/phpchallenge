<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipordersShiptosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shiporders_shiptos', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("address");
            $table->string("city");
            $table->string("country");
            $table->unsignedBigInteger("shiporder_id");
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
        Schema::dropIfExists('shiporders_shiptos');
    }
}
