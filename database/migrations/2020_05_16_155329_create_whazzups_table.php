<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWhazzupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('whazzups', function (Blueprint $table) {
            $table->id();
            $table->string('vid');
            $table->string('callsign')->nullable();
            $table->text('aircraft')->nullable();
            $table->string('departure_time')->nullable();
            $table->string('departure')->nullable();
            $table->string('destination_time')->nullable();
            $table->string('destination')->nullable();
            $table->string('alternate')->nullable();
            $table->string('rule')->nullable();
            $table->text('route')->nullable();
            $table->text('rmk')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
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
        Schema::dropIfExists('whazzups');
    }
}
