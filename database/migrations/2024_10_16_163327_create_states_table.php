<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Importar DB para ejecutar inserciones.

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Insertar valores predeterminados
        DB::table('states')->insert([
            ['id' => 1, 'name' => 'pendiente', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'aceptado', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'rechazado', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('states');
    }
};
