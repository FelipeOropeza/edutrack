<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('faltas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aluno_turma_id')->constrained('aluno_turma')->onDelete('cascade');
            $table->foreignId('disciplina_id')->constrained('disciplinas')->onDelete('cascade');
            $table->foreignId('dia_letivo_id')->constrained('dias_letivos')->onDelete('cascade');
            $table->boolean('presente')->default(true);
            $table->timestamps();

            $table->unique(['aluno_turma_id', 'disciplina_id', 'dia_letivo_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faltas');
    }
};
