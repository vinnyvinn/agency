<?php

use Illuminate\Database\Seeder;
use App\Stage;
class StagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Stage::create(['name'=>'Agency appointment','description'=>'Agency appointment']);
        Stage::create(['name'=>'Pre Arrival documents for master','description'=>'Pre Arrival documents']);
        Stage::create(['name'=>'Declaration of the vessel with KPA','description'=>'Declaration of the vessel with KPA']);
        Stage::create(['name'=>'Manifest','description'=>'Manifest Processing']);
        Stage::create(['name'=>'Processing of Delivery Order/ Release Order','description'=>'Processing of Delivery Order/ Release Order']);
        Stage::create(['name'=>'Job Completion','description'=>'Job Completion']);
        Stage::create(['name'=>'inward clearance','description'=>'inward clearance']);
    }
}
