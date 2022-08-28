<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Role;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Category::updateOrCreate(
            ['name' => 'Umum']
        );
        // \App\Models\User::factory(10)->create();
        $this->call([
            LaratrustSeeder::class,
            //WilayahSeeder::class,
            //RefSeeder::class
        ]);
        $user = User::updateOrCreate(
            [
                'name' => 'Administrator',
                'email' => 'masadi.com@gmail.com',
            ],
            [
                'password' => bcrypt('12345678'),
            ]
        );
        $role = Role::where('name', 'administrator')->first();
        $user->attachRole($role);
    }
}
