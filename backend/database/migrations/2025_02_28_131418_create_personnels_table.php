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
        Schema::create('personnels', function (Blueprint $table) {
            $table->string("code_pers")->primary();
            $table->string("nom_pers", 191);
            $table->string("login_pers", 191);
            $table->string("pwd_pers", 191);
            $table->string("email_pers", 191);
            $table->unsignedBigInteger("id");
            $table->foreign("id")->references("id")->on("services");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnels');
    }
};
