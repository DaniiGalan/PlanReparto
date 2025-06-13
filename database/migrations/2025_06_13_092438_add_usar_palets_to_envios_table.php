<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('envios', function (Blueprint $table) {
            $table->boolean('usar_palets')->default(false)->after('palets');
        });
    }

    public function down()
    {
        Schema::table('envios', function (Blueprint $table) {
            $table->dropColumn('usar_palets');
        });
    }
};
