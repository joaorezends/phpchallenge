<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateLaravelTestDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (config("database.connections.mysql.database") !== "laravel_test") {
            Schema::createDatabase('laravel_test');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (config("database.connections.mysql.database") !== "laravel_test") {
            Schema::dropDatabaseIfExists('laravel_test');
        }
    }
}
