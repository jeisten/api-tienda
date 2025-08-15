<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('propietarios', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nombre');
            $table->string('direccion');
            $table->string('telefono')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('propietarios');
    }
};
