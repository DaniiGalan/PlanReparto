<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListadosTable extends Migration
{
    public function up()
    {
        Schema::create('listados', function (Blueprint $table) {
            $table->id();
            $table->string('zona');
            $table->date('fecha');
            $table->string('pdf_path')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('listados');
    }
}
