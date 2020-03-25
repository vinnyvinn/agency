<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(StagesSeeder::class);
        $this->call(StageComponentSeeder::class);
        $this->call(TariffSeeder::class);
        $this->call(GoodTypeSeeder::class);

//        factory(\App\User::class, 5)->create();
    }
}
