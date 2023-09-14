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
        Schema::create('soals', function (Blueprint $table) {
            $table->id();
            $table->string("judul_soal")->nullable(false);
            $table->integer("poin");
            $table->enum("jenis_soal",["pilihanGanda","isianSingkat"]);
            $table->json("soal_data")->nullable(false);
            $table->foreignId("id_kuis");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soals');
    }
};
