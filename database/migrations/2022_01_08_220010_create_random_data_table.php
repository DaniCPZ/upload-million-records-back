<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRandomDataTable extends Migration
{
    public function up(): void
    {
        Schema::create('random_data', function (Blueprint $table) {
            $table->id();
            $table->string('seq');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('age');
            $table->string('street');
            $table->string('city');
            $table->string('state');
            $table->string('zip');
            $table->string('dollar');
            $table->string('pick');
            $table->string('date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('random_data');
    }
}
