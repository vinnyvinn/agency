<?php

use Illuminate\Database\Seeder;
use App\Tariff;
class TariffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tariff::create(['type' => 'internal', 'name' => 'Agency Transport Charges', 'rate' => 150, 'stk_id' => 242,'buying_price'=>100, 'unit_value' => 1, 'unit_type' => 'per day', 'unit' => 'Per Day']);
        Tariff::create(['type' => 'KPA', 'name' => 'Pilotage', 'rate' => 6, 'stk_id' => 262,'buying_price'=>50, 'unit_value' => 100, 'unit_type' => 'grt', 'unit' => 'Per Move']);
        Tariff::create(['type' => 'kpa', 'name' => 'Tugs (in/out) 1st 10000', 'rate' => 15,'buying_price'=>10, 'stk_id' => 263, 'unit_value' => 100, 'unit_type' => 'First GRT', 'unit' => 'GRT']);
        Tariff::create(['type' => 'KPA', 'name' => 'Tugs (in/out) Thereafter', 'rate' => 7.5, 'stk_id' => 264, 'buying_price'=>4,'unit_value' => 100, 'unit_type' => 'Thereafter GRT', 'unit' => 'GRT']);
        Tariff::create(['type' => 'kpa', 'name' => 'Mooring / Unmooring', 'rate' => 3.3, 'stk_id' => 265, 'buying_price'=>2,'unit_value' => 100, 'unit_type' => 'grt', 'unit' => 'GRT']);
        Tariff::create(['type' => 'kpa', 'name' => 'Port and Harbour Dues', 'rate' => 13, 'stk_id' => 266, 'buying_price'=>10,'unit_value' => 100, 'unit_type' => 'grt', 'unit' => 'GRT']);
        Tariff::create(['type' => 'kpa', 'name' => 'Light Dues', 'rate' => 5.5, 'stk_id' => 267, 'unit_value' => 100, 'buying_price'=>3.5,'unit_type' => 'grt', 'unit' => 'GRT']);
        Tariff::create(['type' => 'kpa', 'name' => 'Dockage', 'rate' => 0.26, 'stk_id' => 268,'buying_price'=>0.2, 'unit_value' => 1, 'unit_type' => 'loa', 'unit' => 'LOA']);
        Tariff::create(['type' => 'kpa', 'name' => 'Port Security Dues', 'rate' => 3.3, 'buying_price'=>3.3,'stk_id' => 269, 'unit_value' => 100, 'unit_type' => 'grt', 'unit' => 'GRT']);
        Tariff::create(['type' => 'internal', 'name' => 'Customs Clearance', 'rate' => 100, 'buying_price'=>50,'stk_id' => 270, 'unit_value' => 1, 'unit_type' => 'Lumpsum', 'unit' => 'Lumpsum']);
        Tariff::create(['type' => 'Internal', 'name' => 'Quarantine Clearance', 'rate' => 100, 'buying_price'=>50,'stk_id' => 271, 'unit_value' => 1, 'unit_type' => 'Lumpsum', 'unit' => 'Lumpsum']);
        Tariff::create(['type' => 'internal', 'name' => 'Immigration Clearance', 'rate' => 100, 'buying_price'=>50,'stk_id' => 272, 'unit_value' => 1, 'unit_type' => 'Lumpsum', 'unit' => 'Lumpsum']);
        Tariff::create(['type' => 'internal', 'name' => 'Crew Shore Pass', 'rate' => 100, 'buying_price'=>50,'stk_id' => 273, 'unit_value' => 1, 'unit_type' => 'Lumpsum', 'unit' => 'Lumpsum']);
        Tariff::create(['type' => 'Internal', 'name' => 'Transport', 'rate' => 150, 'buying_price'=>100,'stk_id' => 274, 'unit_value' => 1, 'unit_type' => 'per day', 'unit' => 'Per Day']);
        Tariff::create(['type' => 'internal', 'name' => 'Communication', 'rate' => 300, 'buying_price'=>150,'stk_id' => 275, 'unit_value' => 1, 'unit_type' => 'Lumpsum', 'unit' => 'Lumpsum']);
        Tariff::create(['type' => 'Internal', 'name' => 'Time Logs and SOF', 'rate' => 100, 'buying_price'=>80,'stk_id' => 276, 'unit_value' => 1, 'unit_type' => 'per day', 'unit' => 'Per Day']);
        Tariff::create(['type' => 'internal', 'name' => 'Draft Survey', 'rate' => 700, 'buying_price'=>500,'stk_id' => 279, 'unit_value' => 1, 'unit_type' => 'Lumpsum', 'unit' => 'Lumpsum']);
        Tariff::create(['type' => 'internal', 'name' => 'Petties', 'rate' => 350,'buying_price'=>200, 'stk_id' => 277, 'unit_value' => 1, 'unit_type' => 'Lumpsum', 'unit' => 'Lumpsum']);
        Tariff::create(['type' => 'internal', 'name' => 'Agency Fees', 'rate' => 2500, 'buying_price'=>1500,'stk_id' => 280, 'unit_value' => 1, 'unit_type' => 'Thereafter Days', 'unit' => 'Per Day']);
        Tariff::create(['type' => 'internal', 'name' => 'Bank Charges', 'rate' => 80, 'buying_price'=>40,'stk_id' => 281, 'unit_value' => 1, 'unit_type' => 'Lumpsum', 'unit' => 'Lumpsum']);
        Tariff::create(['type' => 'KPA', 'name' => 'Stevedoring Charges (Bulk)', 'rate' => 4.4, 'buying_price'=>2.4,'stk_id' => 282, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => 'Per MT']);
        Tariff::create(['type' => 'kpa', 'name' => 'Wharfage (Bulk)', 'rate' => 5.5, 'buying_price'=>4.5,'stk_id' => 283, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => 'Per MT']);
        Tariff::create(['type' => 'internal', 'name' => 'Delivery Order Fee', 'rate' => 75, 'buying_price'=>45,'stk_id' => 284, 'unit_value' => 1, 'unit_type' => 'Lumpsum', 'unit' => 'Lumpsum']);
        Tariff::create(['type' => 'Internal', 'name' => 'Hire Of Hoppers', 'rate' => 0.60, 'buying_price'=>0.20,'stk_id' => 285, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => 'Per MT']);
        Tariff::create(['type' => 'internal', 'name' => 'Hire Of Wheel Loader', 'rate' => 62, 'buying_price'=>40,'stk_id' => 286, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => 'Per Hour']);
        Tariff::create(['type' => 'Internal', 'name' => 'Cargo Expedition and Liner Out', 'rate' => 1.5,'buying_price'=>0.5, 'stk_id' => 287, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => 'MT']);
        Tariff::create(['type' => 'Internal', 'name' => 'Off-Hire Bunker Survey', 'rate' => 850, 'stk_id' => 288,'buying_price'=>500, 'unit_value' => 1, 'unit_type' => 'Lumpsum', 'unit' => 'Lumpsum']);
        Tariff::create(['type' => 'Internal', 'name' => 'Hotel Accomodation', 'rate' => 110, 'stk_id' => 289, 'buying_price'=>80,'unit_value' => 1, 'unit_type' => 'per day', 'unit' => 'Lumpsam']);
        Tariff::create(['type' => 'Internal', 'name' => 'Grab Hire', 'rate' => 0.6, 'stk_id' => 290,'buying_price'=>0.4, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => 'Per Hour']);
        Tariff::create(['type' => 'internal', 'name' => 'Weapons Handling', 'rate' => 150, 'stk_id' => 242, 'buying_price'=>130,'unit_value' => 1, 'unit_type' => 'per day', 'unit' => 'Per Day']);
        Tariff::create(['type' => 'Internal', 'name' => 'Crew Handling', 'rate' => 200, 'buying_price'=>120,'stk_id' => 292, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => 'Per Crew']);
        Tariff::create(['type' => 'Internal', 'name' => 'Fresh Water (Truck)', 'rate' => 12, 'stk_id' => 293,'buying_price'=>10, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => 'Per MT']);
        Tariff::create(['type' => 'internal', 'name' => 'Mission To Seamen', 'rate' => 100, 'buying_price'=>80,'stk_id' => 294, 'unit_value' => 1, 'unit_type' => 'Lumpsum', 'unit' => 'Lumpsum']);
        Tariff::create(['type' => 'internal', 'name' => 'Ship Spares', 'rate' => 1, 'buying_price'=>0.6,'stk_id' => 295, 'unit_value' => 1, 'unit_type' => 'Lumpsum', 'unit' => 'Lumpsum']);
        Tariff::create(['type' => 'internal', 'name' => 'Provision Of Stores', 'rate' => 1, 'buying_price'=>0.5,'stk_id' => 296, 'unit_value' => 1, 'unit_type' => 'Lumpsum', 'unit' => 'Lumpsum']);
        Tariff::create(['type' => 'internal', 'name' => 'Repairs and Maintanance', 'rate' => 1,'buying_price'=>0.5, 'stk_id' => 297, 'unit_value' => 1, 'unit_type' => 'Lumpsam', 'unit' => 'Lumpsam']);
        Tariff::create(['type' => 'internal', 'name' => 'Tallying and Cargo Survey', 'rate' => 0.25, 'buying_price'=>0.15,'stk_id' => 298, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => 'Per Mt']);
        Tariff::create(['type' => 'Internal', 'name' => 'Holds Cleaning by air blowing', 'rate' => 2000, 'buying_price'=>1500,'stk_id' => 299, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => 'Per Hold']);
        Tariff::create(['type' => 'internal', 'name' => 'Cash To Master', 'rate' => 1, 'stk_id' => 300, 'buying_price'=>0.4,'unit_value' => 1, 'unit_type' => 'Lumpsum', 'unit' => 'Lumpsum']);
        Tariff::create(['type' => 'internal', 'name' => 'Tours and Safari', 'rate' => 1, 'buying_price'=>0.5,'stk_id' => 301, 'unit_value' => 1, 'unit_type' => 'Lumpsum', 'unit' => 'Lumpsum']);
        Tariff::create(['type' => 'internal', 'name' => 'Crew Medication', 'rate' => 1,'buying_price'=>0.4, 'stk_id' => 303, 'unit_value' => 1, 'unit_type' => 'Lumpsum', 'unit' => 'Lumpsum']);
        Tariff::create(['type' => 'internal', 'name' => 'Hull Inspection', 'rate' => 800, 'buying_price'=>600,'stk_id' => 305, 'unit_value' => 1, 'unit_type' => 'Lumpsam', 'unit' => 'Lumpsam']);
        Tariff::create(['type' => 'internal', 'name' => 'Bonus and Incentives (General for bulk)', 'buying_price'=>1.2,'rate' => 2, 'stk_id' => 306, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => 'Per MT']);
        Tariff::create(['type' => 'Internal', 'name' => 'Equipment Hire for steel & BB Cargoes', 'buying_price'=>0.5,'rate' => 1.5, 'stk_id' => 307, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => 'Per MT']);
        Tariff::create(['type' => 'internal', 'name' => 'Cargo Reconstitution and Rebbaging', 'buying_price'=>0.5,'rate' => 1.5, 'stk_id' => 308, 'unit_value' => 1, 'unit_type' => 'Lumpsum', 'unit' => 'Lumpsum']);
        Tariff::create(['type' => 'internal', 'name' => 'Northern Corridor Levy', 'rate' => 1, 'buying_price'=>0.4,'stk_id' => 310, 'unit_value' => 1, 'unit_type' => 'Lumpsum', 'unit' => 'Lumpsum']);
        Tariff::create(['type' => 'KPA', 'name' => 'Anchorage Dues', 'rate' => 150, 'stk_id' => 312, 'buying_price'=>100,'unit_value' => 1, 'unit_type' => 'Lumpsum', 'unit' => 'Lumpsum']);
        Tariff::create(['type' => 'kpa', 'name' => 'Mooring at bouys', 'rate' => 3.3, 'buying_price'=>1.3,'stk_id' => 357, 'unit_value' => 1, 'unit_type' => 'grt', 'unit' => 'Lumpsam']);
        Tariff::create(['type' => 'Internal', 'name' => 'Watchmen', 'rate' => 120, 'buying_price'=>80,'stk_id' => 278, 'unit_value' => 1, 'unit_type' => 'per day', 'unit' => 'Per Day']);
        Tariff::create(['type' => 'Internal', 'name' => 'Custom / Immigration / Port Health Clearance', 'buying_price'=>200,'rate' => 300, 'stk_id' => 359, 'unit_value' => 1, 'unit_type' => 'Lumpsum', 'unit' => 'Lumpsum']);
        Tariff::create(['type' => 'KPA', 'name' => 'Bouyage', 'rate' => 0.13, 'stk_id' => 362, 'buying_price'=>0.03,'unit_value' => 1, 'unit_type' => 'loa', 'unit' => 'Per Hour']);
        Tariff::create(['type' => 'kpa', 'name' => 'Fresh Water (Barge)', 'rate' => 20, 'stk_id' => 363, 'buying_price'=>10,'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => 'Per MT']);
        Tariff::create(['type' => 'kpa', 'name' => 'Stevedoring Charges (B/B)', 'rate' => 7.5, 'buying_price'=>2.5,'stk_id' => 364, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => 'Per MT']);
        Tariff::create(['type' => 'ii', 'name' => 'internal', 'rate' => 1.50, 'stk_id' => 381, 'unit_value' => 1, 'buying_price'=>0.50,'unit_type' => 'Per Unit', 'unit' => 'MT']);
        Tariff::create(['type' => 'internal', 'name' => 'Protective Agency fee', 'rate' => 1500,'buying_price'=>1000, 'stk_id' => 382, 'unit_value' => 1, 'unit_type' => 'Lumpsum', 'unit' => 'Lumpsum']);
        Tariff::create(['type' => 'internal', 'name' => 'Cargo Lashing / unlashing', 'rate' => 150, 'buying_price'=>100, 'stk_id' => 383, 'unit_value' => 1, 'unit_type' => 'Per Unit  ', 'unit' => 'Per Shift']);
        Tariff::create(['type' => 'internal', 'name' => 'Cargo Lashing / unlashing', 'rate' => 100, 'buying_price'=>80,'stk_id' => 384, 'unit_value' => 1, 'unit_type' => 'Lumpsum', 'unit' => 'Per Shift']);
        Tariff::create(['type' => 'internal', 'name' => 'KPA Equipment Hire', 'rate' => 0.8,'buying_price'=>0.4, 'stk_id' => 385, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => 'Per MT']);
        Tariff::create(['type' => 'internal', 'name' => 'Boat Hire', 'rate' => 100,'buying_price'=>60, 'stk_id' => 386, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => '100']);
        Tariff::create(['type' => 'internal', 'name' => 'Agency fee (Liner Agency)', 'rate' => 2000,'buying_price'=>1500, 'stk_id' => 387, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => 'Lumpsum']);
        Tariff::create(['type' => 'internal', 'name' => 'Container Unlashing / Lashing', 'rate' => 10,'buying_price'=>8, 'stk_id' => 389, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => 'Per Unit']);
        Tariff::create(['type' => 'kpa', 'name' => 'Container Stevedoring 20\' FCL', 'rate' => 120,'buying_price'=>100, 'stk_id' => 390, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => 'Per Move']);
        Tariff::create(['type' => 'kpa', 'name' => 'Stevedoring 40\' FCL', 'rate' => 180,'buying_price'=>120, 'stk_id' => 391, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => 'Per Move']);
        Tariff::create(['type' => 'internal', 'name' => 'Gang expedition', 'rate' => 150, 'buying_price'=>120,'stk_id' => 392, 'unit_value' => 1, 'unit_type' => 'per day', 'unit' => 'Per Shift']);
        Tariff::create(['type' => 'kpa', 'name' => 'Container Stevedoring 40\' Empty', 'rate' => 89, 'buying_price'=>49,'stk_id' => 393, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => 'Per Move']);
        Tariff::create(['type' => 'kpa', 'name' => 'Shorehandling for breakbulk', 'rate' => 60, 'buying_price'=>50,'stk_id' => 395, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => '21DWT TO 50DWT']);
        Tariff::create(['type' => 'kpa', 'name' => 'Shorehandling for breakbulk', 'rate' => 100, 'buying_price'=>50,'stk_id' => 396, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => '51 DWT TO 80 DWT']);
        Tariff::create(['type' => 'kpa', 'name' => 'Shorehandling for breakbulk', 'rate' => 200, 'buying_price'=>100,'stk_id' => 396, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => 'OVER 80 DWT']);
        Tariff::create(['type' => 'kpa', 'name' => 'Shorehandling for breakbulk', 'rate' => 60, 'buying_price'=>40,'stk_id' => 396, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => 'AWKWARD PACKAGES OVER 45 CBM']);
        Tariff::create(['type' => 'internal', 'name' => 'Liner out handling', 'rate' => 8000,'buying_price'=>6000, 'stk_id' => 397, 'unit_value' => 1, 'unit_type' => 'Lumpsum', 'unit' => 1]);
        Tariff::create(['type' => 'kpa', 'name' => 'Stevedore Charges', 'rate' => 70,'buying_price'=>60, 'stk_id' => 402, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => 'Saloon,Station wagon, Van, CUV not exceeding 1.5mt']);
        Tariff::create(['type' => 'kpa', 'name' => 'Stevedore Charges', 'rate' => 95, 'buying_price'=>60,'stk_id' => 403, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => 'Station Wagon,Pick up,SUV,CUV not Exceeding 2.0mt']);
        Tariff::create(['type' => 'kpa', 'name' => 'Stevedore Charges', 'rate' => 300,'buying_price'=>200, 'stk_id' => 403, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => 'Mid Sized Trucks,Min bus, Tractor not exceeding 5mt']);
        Tariff::create(['type' => 'kpa', 'name' => 'Stevedore Charges', 'rate' => 500, 'buying_price'=>400,'stk_id' => 403, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => 'Bus Trucks,Tractors,Light Fork Lift not exceeding 10mt']);
        Tariff::create(['type' => 'kpa', 'name' => 'Stevedore Charges', 'rate' => 800, 'buying_price'=>700,'stk_id' => 403, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => 'Construction/ind.vehicle,Heavy Duty Lifting Equipt 10mt']);
        Tariff::create(['type' => 'kpa', 'name' => 'Shire Handling', 'rate' => 80,'buying_price'=>50, 'stk_id' => 404, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => 'Saloon, Station Wagon, Van, Cuv not exceeding 1.5mt']);
        Tariff::create(['type' => 'kpa', 'name' => 'Shore Handling Charges', 'rate' => 105, 'buying_price'=>80,'stk_id' => 405, 'unit_value' => 1, 'unit_type' => 'per day', 'unit' => 'Station Wagon,Pick up,SUV,CUV not Exceeding 2.0mt']);
        Tariff::create(['type' => 'kpa', 'name' => 'Shore Handling Charges', 'rate' => 265,'buying_price'=>200, 'stk_id' => 406, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => 'Mid Sized Trucks,Min bus, Tractor not exceeding 5mt']);
        Tariff::create(['type' => 'kpa', 'name' => 'Shore Handling Charges', 'rate' => 665, 'buying_price'=>550,'stk_id' => 406, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => 'Bus Trucks,Tractors,Light Fork Lift not exceeding 10mt']);
        Tariff::create(['type' => 'kpa', 'name' => 'Shore Handling Charges', 'rate' => 1065,'buying_price'=>900, 'stk_id' => 406, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => 'Construction/ind.vehicle,Heavy Duty Lifting Equipt 10mt']);
        Tariff::create(['type' => 'kpa', 'name' => 'Liner Out Cost/ cargo expedition', 'rate' => 1.47, 'buying_price'=>0.47,'stk_id' => 407, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => 'per Mt']);
        Tariff::create(['type' => 'internal', 'name' => 'Liner Out Cost/ cargo expedition','buying_price'=>0.2, 'rate' => 0.6, 'stk_id' => 408, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => 'per Mt']);
        Tariff::create(['type' => 'internal', 'name' => 'Cargo Expedition and Liner out Costs', 'buying_price'=>0.45,'rate' => 0.85, 'stk_id' => 409, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => 'per Mt']);
        Tariff::create(['type' => 'internal', 'name' => 'Agency Fee', 'rate' => 0.1, 'stk_id' => 388,'buying_price'=>0.04, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => 'Per Mt']);
        Tariff::create(['type' => 'kpa', 'name' => 'TUG SERV. (BERTH/UNBERTH) WITHIN 2 MILES', 'buying_price'=>5,'rate' => 15, 'stk_id' => 410, 'unit_value' => 1, 'unit_type' => 'grt', 'unit' => 'PER GRT']);
        Tariff::create(['type' => 'internal', 'name' => 'AGENCY FEE', 'rate' => 2500, 'buying_price'=>2000,'stk_id' => 388, 'unit_value' => 1, 'unit_type' => 'Thereafter Days', 'unit' => 'LUMPSUM']);
        Tariff::create(['type' => 'internal', 'name' => 'CargoDischarge Expedition cost', 'buying_price'=>0.47,'rate' => 1.47, 'stk_id' => 411, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => 'per Mt']);
        Tariff::create(['type' => 'internal', 'name' => 'Agency Fee', 'rate' => 0.03, 'stk_id' => 388, 'unit_value' => 1,'buying_price'=>0.01, 'unit_type' => 'Per Unit', 'unit' => 'per Mt']);
        Tariff::create(['type' => 'kpa', 'name' => 'Okwardnpackages over 45CBM', 'rate' => 60, 'stk_id' => 412,'buying_price'=>40, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => 1]);
        Tariff::create(['type' => 'kpa', 'name' => 'Stevedore Charges', 'rate' => 1.65,'buying_price'=>1.45, 'stk_id' => 403, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => 'per Mt']);
        Tariff::create(['type' => 'internal', 'name' => 'Hotel Accomodation charges', 'rate' => 110, 'buying_price'=>900,'stk_id' => 415, 'unit_value' => 1, 'unit_type' => 'Per Unit  ', 'unit' => 'per night']);
        Tariff::create(['type' => 'internal', 'name' => 'Port movement pass', 'rate' => 50,'buying_price'=>30, 'stk_id' => 416, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => 'Per Person']);
        Tariff::create(['type' => 'internal', 'name' => 'Transport cost hotel to Ship and back', 'buying_price'=>35,'rate' => 50, 'stk_id' => 417, 'unit_value' => 1, 'unit_type' => 'Thereafter Days', 'unit' => 'Per Trip']);
        Tariff::create(['type' => 'KPA', 'name' => 'STEVEDORING CHARGES LOADING', 'rate' => 1, 'buying_price'=>0.4,'stk_id' => 422, 'unit_value' => 1, 'unit_type' => 'Per Unit', 'unit' => 'Per Mt']);
        Tariff::create(['type' => 'kpa', 'name' => 'Pilotage', 'rate' => 6, 'stk_id' => 423,'buying_price'=>5, 'unit_value' => 100, 'unit_type' => 'grt', 'unit' => 'unit']);
    }
}