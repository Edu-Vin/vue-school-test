<?php

namespace Database\Seeders;

use App\Entities\Users\UserEntity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserEntity::factory()->count(20)->create();
    }
}
