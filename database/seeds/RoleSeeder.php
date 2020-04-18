<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();

        $data = [
              [
                'name'=>'Admin',
                'slug'=>'admin',
                'permissions'=>json_encode([
                    'manage-user'=>true,
                    'admin'=>true,
                    'manage-roles'=>true,
                    'generate-quotation'=>true,
                    'view-quotation'=>true,
                    'approve-quotation'=>true,
                    'manage-cargo-types'=>true,
                    'manage-container-types'=>true,
                    'manage-stages'=>true,
                    'manage-leads'=>true,
                    'manage-tariffs'=>true,
                    'manage-pdas'=>true,
                    'manage-fdas'=>true,
                    'manage-dsr'=>true,
                    'manage-customers'=>true,
                    'can-delete'=>true,
                    'can-edit-quote'=>true,
                    'can-add-remittance'=>true,
                    'can-delete-quote'=>true
                ]),
                'created_at'=>$now,
                'updated_at'=>$now
            ]
        ];

        \App\Role::insert($data);
    }
}
