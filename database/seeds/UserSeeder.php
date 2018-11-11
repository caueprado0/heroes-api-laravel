<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        factory(\Heroes\Usuario\Model\Usuario::class, 2)->create();
    }
}
