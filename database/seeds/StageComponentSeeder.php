<?php

use App\StageComponent;
use Illuminate\Database\Seeder;

class StageComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StageComponent::create(['stage_id' =>1,'name'=>'Full Agent','type'=>'text','required'=>1,'description'=>'Acting on behalf of the ship owner and cargo receiver','components'=>'']);
        StageComponent::create(['stage_id' =>1,'name'=>'Receivers nominated Agent','type'=>'text','required'=>1,'description'=>'Acting on behalf of cargo receiver only','components'=>'']);
        StageComponent::create(['stage_id' =>1,'name'=>'Security Agent','type'=>'text','required'=>1,'description'=>'Arms disemberkation and Emberkation/ export','components'=>'']);
        StageComponent::create(['stage_id' =>1,'name'=>'Bunkering Agent','type'=>'text','required'=>1,'description'=>'Supply of Bunkers','components'=>'']);
        StageComponent::create(['stage_id' =>1,'name'=>'Crewing Agent','type'=>'text','required'=>1,'description'=>'Onsigners/off signers','components'=>'']);
        StageComponent::create(['stage_id' =>2,'name'=>'Stowage plan','type'=>'file','required'=>1,'description'=>'how cargo is stowed on board','components'=>'']);
        StageComponent::create(['stage_id' =>2,'name'=>'Ships particulars','type'=>'file','required'=>1,'description'=>'Vessel status','components'=>'']);
        StageComponent::create(['stage_id' =>2,'name'=>'Crew list','type'=>'file','required'=>1,'description'=>'Shows total number and names  of seamen on board the vessel','components'=>'']);
        StageComponent::create(['stage_id' =>2,'name'=>'Cargo Manifest','type'=>'file','required'=>1,'description'=>'Shows indepedent receivers for the cargo on board','components'=>'']);
        StageComponent::create(['stage_id' =>3,'name'=>'ships particulars water form','type'=>'file','required'=>1,'description'=>'ships particulars and water form','components'=>'["ships particulars"," water form"]']);
        StageComponent::create(['stage_id' =>4,'name'=>'Bills of Lading','type'=>'file','required'=>1,'description'=>'Bills of Lading','components'=>'["Bills of Lading"]']);
        StageComponent::create(['stage_id' =>5,'name'=>'Processing of Delivery Order/ Release Order','type'=>'file','required'=>1,'description'=>'Hard copy and E-delivery order subtion','components'=>'["Hard copy and E-delivery order subtion"]']);
        StageComponent::create(['stage_id' =>6,'name'=>'outward clearance','type'=>'file','required'=>1,'description'=>'KPA Clearance Certificat','components'=>'["KPA Clearance Certificate"]']);
        StageComponent::create(['stage_id' =>7,'name'=>'F147','type'=>'text','required'=>1,'description'=>'Customs clearance','components'=>'["Customs clearance"]']);
    }
}
