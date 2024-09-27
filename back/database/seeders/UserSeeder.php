<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $user = User::create([
            'name' => 'Gerardo Britez',
            'email' => 'gerardo@gmail.com',
            'password' => bcrypt(123456),
        ]);
        $user->roles()->attach($adminRole);

    }
}
