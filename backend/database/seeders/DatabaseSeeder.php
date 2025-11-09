<?php

namespace Database\Seeders;

use App\Models\Etudiant;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Etudiant::factory(1000)->create();
    }
}
