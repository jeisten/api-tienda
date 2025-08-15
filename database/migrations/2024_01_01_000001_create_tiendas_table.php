<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tiendas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('propietario_id');
            $table->date('fecha_permiso');
            $table->string('foto_url')->nullable();
            $table->string('certificado_bomberos')->nullable();
            $table->string('sayco_acinpro')->nullable();
            $table->decimal('latitud', 10, 8)->nullable();
            $table->decimal('longitud', 11, 8)->nullable();
            $table->text('direccion_tienda');
            $table->timestamps();

            $table->foreign('propietario_id')->references('id')->on('propietarios')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tiendas');
    }
};
