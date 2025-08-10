<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    Category::create(['name' => 'Action']);
    Category::create(['name' => 'Comedy']);
    Category::create(['name' => 'Drama']);
    Category::create(['name' => 'Horror']);
    Category::create(['name' => 'Sci-Fi']);
    Category::create(['name' => 'Fantasy']);
    Category::create(['name' => 'Romance']);
    Category::create(['name' => 'Thriller']);
    Category::create(['name' => 'Documentary']);
    Category::create(['name' => 'Animation']);
    Category::create(['name' => 'Adventure']);
    Category::create(['name' => 'Mystery']);
    Category::create(['name' => 'Crime']);
    Category::create(['name' => 'Musical']);
    Category::create(['name' => 'Biography']);
    Category::create(['name' => 'Family']);
    Category::create(['name' => 'Western']);
    Category::create(['name' => 'War']);
    Category::create(['name' => 'History']);
    Category::create(['name' => 'Sport']);
    Category::create(['name' => 'Noir']);
    Category::create(['name' => 'Short']);
    Category::create(['name' => 'Reality']);
    Category::create(['name' => 'Superhero']);
    }
}
