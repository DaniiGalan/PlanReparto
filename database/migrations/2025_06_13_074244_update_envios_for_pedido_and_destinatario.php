<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('envios', function (Blueprint $table) {
            $table->dropColumn('direccion');
            $table->string('pedido')->after('nombre_cliente');
            $table->string('destinatario')->nullable()->after('pedido');
        });
    }

    public function down()
    {
        Schema::table('envios', function (Blueprint $table) {
            $table->dropColumn('pedido');
            $table->dropColumn('destinatario');
            $table->string('direccion')->after('nombre_cliente');
        });
    }
};
