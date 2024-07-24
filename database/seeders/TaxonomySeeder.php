<?php

namespace Database\Seeders;

use ClarityTech\Cms\Models\Taxonomy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaxonomySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Taxonomy::factory()->count(10)->create();
    }
}
