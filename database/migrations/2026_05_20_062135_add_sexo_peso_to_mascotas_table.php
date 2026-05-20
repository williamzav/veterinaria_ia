<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('mascotas', function (Blueprint $table) {
            $table->string('sexo')->nullable()->after('raza');
            $table->decimal('peso', 6, 2)->nullable()->after('sexo');
            $table->string('motivo_consulta')->nullable()->after('peso');
        });
    }

    public function down(): void
    {
        Schema::table('mascotas', function (Blueprint $table) {
            $table->dropColumn(['sexo', 'peso', 'motivo_consulta']);
        });
    }
};
