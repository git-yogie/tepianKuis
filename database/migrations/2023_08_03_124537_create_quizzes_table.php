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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string("kuis_code")->unique()->nullable(false);
            $table->string("nama")->nullable(false);
            $table->string("mata_pelajaran")->nullable(false);
            $table->enum("tingkatan",["PAUD","TK","SD","SMP","SMA","SMK","Perguruan Tinggi"]);
            $table->foreignId("user_id");
            $table->string("banner")->nullable(true)->default(null);
            $table->json("konfigurasi")->default(null);
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
