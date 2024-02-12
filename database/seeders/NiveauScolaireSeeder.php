<?php

namespace Database\Seeders;

use App\Models\NiveauScolaire;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NiveauScolaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NiveauScolaire::create(["nom" => "6éme"]);
        NiveauScolaire::create(["nom" => "5éme"]);
        NiveauScolaire::create(["nom" => "4éme"]);
        NiveauScolaire::create(["nom" => "3éme"]);
    }
}
