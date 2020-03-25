<?php

use Illuminate\Database\Seeder;
use App\GoodType;
class GoodTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GoodType::create(['name'=>'Containerized','description'=>'Containerized']);
        GoodType::create(['name'=>'Bulk','description'=>'Bulk Cargo']);
        GoodType::create(['name'=>'Bagged','description'=>'Bagged']);
        GoodType::create(['name'=>'General Cargo','description'=>'General Cargo']);
        GoodType::create(['name'=>'Liquid Bulk','description'=>'Liquid Bulk']);
        GoodType::create(['name'=>'Units','description'=>'Vehicles']);
        GoodType::create(['name'=>'Animals','description'=>'Livestock']);
        GoodType::create(['name'=>'Liquefied Gas','description'=>'Liquid Petroleum Gas, Liquid Natural Gas']);
    }
}
