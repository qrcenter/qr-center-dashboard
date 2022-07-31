<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $admin = new User();
        $admin->name = 'Admin';
        $admin->email = 'admin@example.com';
        $admin->password = bcrypt('password');
        $admin->save();
        $admin->roles()->attach(Role::where('name', 'مدير')->first());
    }
}
