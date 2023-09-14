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
        Schema::create('peserta_quizzes', function (Blueprint $table) {
            
            $table->id();
            $table->foreignId("id_peserta");
            $table->foreignId("id_kuis");
            $table->string("kuis_code");
            $table->foreignId("id_user");
            $table->json("jawaban_kuis_cbt");
            $table->json("jawaban_kuis_embed");
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta_quizzes');
    }
};
