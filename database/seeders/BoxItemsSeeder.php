<?php

namespace Database\Seeders;

use App\Models\BoxesItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BoxItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BoxesItem::factory()->count(150)->create();
    }
}
