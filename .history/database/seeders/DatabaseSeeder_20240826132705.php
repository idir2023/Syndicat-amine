<?php

namespace Database\Seeders;
use Hash
use App\Models\User;
use App\Models\Document;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Residence;
use App\Models\Commentaire;
use App\Models\Reclamation;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'), // You can use any password you want
            'is_admin' => true // Assuming you have an `is_admin` field to distinguish admin users
        ]);

        // Create 10 residences
        Residence::factory(10)->create();

        // // Create 100 users
        User::factory(100)->create();

        // Create 30 reclamations
        // Reclamation::factory(30)->create();

        // Document::factory(10)->create();

    }
}
