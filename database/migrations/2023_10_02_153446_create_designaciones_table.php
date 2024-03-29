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
        Schema::create('designaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empleado_id')->constrained();
            $table->foreignId('turno_id')->constrained();
            $table->date('fechaInicio');
            $table->date('fechaFin');  
            $table->integer('intervalo_hv');
            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('designaciones');
    }
};
