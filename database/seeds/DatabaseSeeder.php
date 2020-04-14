<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {

        $this->call([crear_competidores::class]);

         $this->call(UsersTableSeeder::class);
        $this->call([
            crear_competidores::class 
    	]);

    }
}
