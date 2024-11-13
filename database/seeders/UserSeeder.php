<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create(['email'=>'user@gmail.com']);
        User::factory()->create(['email'=>'admin@gmail.com']);
        User::factory()->create(['email'=>'employee@gmail.com']);
    }
}
