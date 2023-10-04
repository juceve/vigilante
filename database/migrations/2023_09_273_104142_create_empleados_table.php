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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');
            $table->string('apellidos');
            $table->foreignId('tipodocumento_id')->nullable()->constrained();
            $table->string('cedula',25);
            $table->string('nacionalidad')->nullable();
            $table->string('direccion');
            $table->string('telefono',50);
            $table->string('email',100);
            $table->foreignId('area_id')->nullable()->constrained();
            $table->foreignId('oficina_id')->nullable()->constrained();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
