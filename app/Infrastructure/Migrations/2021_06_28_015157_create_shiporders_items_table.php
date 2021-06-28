<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipordersItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shiporders_items', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->text("note");
            $table->unsignedInteger("quantity");
            $table->decimal("price", 9, 2);
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
        Schema::dropIfExists('shiporders_items');
    }
}
