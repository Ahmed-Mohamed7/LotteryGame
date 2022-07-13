<?php

namespace Database\Seeders;

use App\Models\Box;
use App\Models\BoxesItem;
use App\Models\Items;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(UserSeeder::class);
        $this->call(BoxSeeder::class);
        $this->call(ItemsSeeder::class);
        $this->call(BoxItemsSeeder::class);
    }
}
