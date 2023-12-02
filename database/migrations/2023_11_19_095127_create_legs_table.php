<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLegsTable extends Migration
{
    public function up()
    {
        Schema::create('legs', function (Blueprint $table) {
            $table->id();
            $table->integer('leg_number');
            $table->integer('turn')->default(0); // Added turn attribute

            $table->foreignId('set_id')->constrained('sets')->onDelete('cascade');
            $table->foreignId('winner_id')->nullable()->constrained('sets')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('legs');
    }
}
