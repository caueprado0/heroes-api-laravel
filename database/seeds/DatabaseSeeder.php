<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Seed de Usuarios');
        $this->call(UserSeeder::class);
        $this->command->info('---------Finalizado o db:seed---------');
    }
}
