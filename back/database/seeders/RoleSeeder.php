<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => RoleEnum::ADMIN->value]);
        Role::create(['name' => RoleEnum::ASSISTANT->value]);
        Role::create(['name' => RoleEnum::CLIENT->value]);
    }
}
