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
        Schema::create('departamentos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->integer('status')->default(1);
            $table->unsignedBigInteger('id_pais');
            $table->softDeletes();
            $table->timestamps();
            
            $table->foreign('id_pais')->references('id')->on('paises');
            //$table->foreignId('id_pais')->constrained('paises')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departamentos');
    }
};
