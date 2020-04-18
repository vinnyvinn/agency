<?php

use App\Mail\UserCreated;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Mail;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::create(['name' => 'Super Admin','email' => 'superadmin@esl.com','password' => bcrypt('Qwerty123!')]);
       $user1->roles()->attach(1);
        $user2 =User::create(['name' => 'Francis Opalo','email' => 'francis.opalo@esl-eastafrica.com','password' => bcrypt('Qwerty123!')]);
        $user2->roles()->attach(1);
        $user3 =User::create(['name' => 'Evans Ngala','email' => 'evans.ngala@esl-eastafrica.com','password' => bcrypt('Qwerty123!')]);
        $user3->roles()->attach(1);
        $user4 =User::create(['name' => 'Raymond Wagunda','email' => 'raymond.wangunda@esl-eastafrica.com','password' => bcrypt('Qwerty123!')]);
        $user4->roles()->attach(1);
        $user5 =User::create(['name' => 'Guljan Abubakar','email' => 'sguljan.abubakar@esl-eastafrica.com','password' => bcrypt('Qwerty123!')]);
        $user5->roles()->attach(1);
        $user6 =User::create(['name' => 'Maurine Atieno Opiyo','email' => 'maurine.atieno@esl-eastafrica.com','password' => bcrypt('Qwerty123!')]);
        $user6->roles()->attach(1);
        $user7 =User::create(['name' => 'Leonard Baya','email' => 'leonard.baya@esl-eastafrica.com','password' => bcrypt('Qwerty123!')]);
        $user7->roles()->attach(1);
        $user8 =User::create(['name' => 'Silvester Kututa','email' => 'silvester@esl-eastafrica.com','password' => bcrypt('Qwerty123!')]);
        $user8->roles()->attach(1);
        $user9 =User::create(['name' => 'Lenrod Mwamburi','email' => 'lenrod.mwamburi@esl-eastafrica.com','password' => bcrypt('Qwerty123!')]);
        $user9->roles()->attach(1);
        $user10 =User::create(['name' => 'John Lagat','email' => 'john.lagat@esl-eastafrica.com','password' => bcrypt('Qwerty123!')]);
        $user10->roles()->attach(1);
        $user11 = User::create(['name' => 'Martin Karani IKiara','email' => 'martin.karani@esl-eastafrica.com','password' => bcrypt('Qwerty123!')]);
        $user11->roles()->attach(1);
        $user12 =User::create(['name' => 'Benson Ireri   ','email' => 'benson.ireri@esl-eastafrica.com','password' => bcrypt('Qwerty123!')]);
        $user12->roles()->attach(1);
        $user13 =User::create(['name' => 'COLLINS ONYANGO PAMBA','email' => 'accounts@esl-eastafrica.com','password' => bcrypt('Qwerty123!')]);
        $user13->roles()->attach(1);
        $user14 =User::create(['name' => 'phanice omunanje','email' => 'phanice.omunanje@esl-eastafrica.com','password' => bcrypt('Qwerty123!')]);
        $user14->roles()->attach(1);
        $user15 =User::create(['name' => 'Mercyline Mutua','email' => 'mercyline.mutua@esl-eastafrica.com','password' => bcrypt('Qwerty123!')]);
        $user15->roles()->attach(1) ;
       // $user->roles()->attach(1);
    }
}
