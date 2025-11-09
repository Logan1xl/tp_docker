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
        Schema::create('traitements', function (Blueprint $table) {
            $table->string("code", 10);
            $table->unsignedBigInteger("id"); // Doit correspondre au type de services.id
            $table->date("date_req")->default(now());
            $table->text("contenu");
            $table->integer("statut")->default(0);
            $table->unsignedBigInteger("service_id"); // Renommé pour plus de clarté
            
            // Clé primaire composite
            $table->primary(["code", "id"]);
            
            // Clés étrangères corrigées
            $table->foreign("code")->references("code")->on("requetes")->onDelete('cascade');
            $table->foreign("service_id")->references("id")->on("services")->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traitements');
    }
};