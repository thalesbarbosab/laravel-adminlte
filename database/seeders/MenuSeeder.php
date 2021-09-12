<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu')->insert([
            ['description'=>'Clientes','icon'=>'fas fa-users','actived'=>true],
            ['description'=>'Financeiro','icon'=>'fas fa-piggy-bank','actived'=>true],
            ['description'=>'Comercial','icon'=>'fas fa-phone-square','actived'=>true],
            ['description'=>'Suporte','icon'=>'fas fa-headset','actived'=>false],
            ['description'=>'Direção','icon'=>'fas fa-chart-line','actived'=>true],
        ]);
    }
}
