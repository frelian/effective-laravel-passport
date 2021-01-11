<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 9)->create();

        // Creo un usuario administrador con mis datos
        User::create([
            'names'    => 'Julian Niño',
            'email'    => 'frelian@gmail.com',
            'password' => bcrypt('123'),
            'role'     => 'admin'
        ]);
    }
}
