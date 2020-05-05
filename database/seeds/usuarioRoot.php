<?php

use Illuminate\Database\Seeder;
use App\User;

class usuarioRoot extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Root',
            'email' => 'root@mail.com',
            'password' => bcrypt('root123'),
            'idtipoUsuario' => '1',
        ]);
    }
}