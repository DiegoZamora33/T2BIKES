<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(CrearEstatus::class);
        $this->call(tiposUsuario::class);
        $this->call(tiposCarrera::class);
    }
}
