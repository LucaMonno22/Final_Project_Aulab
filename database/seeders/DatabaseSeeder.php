<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $categories = ['Electronics', 'Clothing', 'Home', 'Motors', 'Sports', 'Books', 'Games', 'Music', 'Collectibles'];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }

        //User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
