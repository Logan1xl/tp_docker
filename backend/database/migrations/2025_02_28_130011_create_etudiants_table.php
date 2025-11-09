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
        Schema::create('etudiants', function (Blueprint $table) {
            $table->string("matricule", 12)->primary();
            $table->string("nom", 191);
            $table->string("prenom", 191)->nullable();
            $table->string("sexe", 1)->default("F");
            $table->string("email", 191)->unique();
            $table->string("telephone", 20);
            $table->string("login", 191);
            $table->string("password", 191);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etudiants');
    }
};
