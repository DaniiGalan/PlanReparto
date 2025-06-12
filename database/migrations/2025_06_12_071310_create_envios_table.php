<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnviosTable extends Migration
{
    public function up()
    {
        Schema::create('envios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_cliente');
            $table->string('direccion'); // Número de pedido o "INCIDENCIA"
            $table->string('zona');
            $table->string('etiqueta_pdf')->nullable(); // Si guardas el PDF en algún momento
            $table->foreignId('listado_id')->nullable()->constrained()->onDelete('set null');
            $table->boolean('enlistado')->default(false);
            $table->integer('bultos')->nullable();
            $table->integer('palets')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('envios');
    }
}
