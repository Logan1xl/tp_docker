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
        Schema::create('requetes', function (Blueprint $table) {
            $table->string("code", 10)->primary();
            $table->string("objet", length: 191);
            $table->string("description", 191);
            $table->string("preuve", 191);
            $table->string("matricule", 12);
            $table->foreign("matricule")->references("matricule")->on("etudiants");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requetes');
    }
};
