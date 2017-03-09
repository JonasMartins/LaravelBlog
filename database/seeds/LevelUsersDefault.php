<?php

use Illuminate\Database\Seeder;

class LevelUsersDefault extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
      /* ao instalar o site blog rodar estes seeders para iniciar os levels de users padrão */
      DB::table('user_levels')->insert([
            array('id' => 1,'level' => 'Basic'),
            array('id' => 2,'level' => 'Author'),
            array('id' => 3,'level' => 'Admin')
        ]);
    }
}
