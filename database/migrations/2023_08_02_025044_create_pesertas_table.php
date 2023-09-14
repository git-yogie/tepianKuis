<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pesertas', function (Blueprint $table) {
            $table->id();
            $table->string("nama")->nullable(false);
            $table->string("nis")->nullable(false)->default(0)->unique();
            $table->string("email")->nullable(false)->unique();
            $table->string("kelas")->nullable(false)->default(0);
            $table->foreignIdFor(User::class,"id_users");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesertas');
    }
};
