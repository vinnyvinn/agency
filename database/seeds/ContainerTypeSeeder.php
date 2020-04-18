<?php

use Illuminate\Database\Seeder;
use App\ContainerType;
class ContainerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContainerType::create(['name'=>'','description'=>'']);
    }
}
