<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('professor_turma_disciplina', function (Blueprint $table) {
            $table->id();
            $table->foreignId('professor_id')->constrained()->onDelete('cascade');
            $table->foreignId('turma_id')->constrained()->onDelete('cascade');
            $table->foreignId('disciplina_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['professor_id', 'turma_id', 'disciplina_id'], 'prof_tur_disc_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('professor_turma_disciplina');
    }
};
