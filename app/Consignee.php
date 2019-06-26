<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class Consignee extends ESLModel
{
    protected $fillable = ['quotation_id','cargo_id','consignee_name',
        'consignee_email','consignee_tel','consignee_address'];

    public function cargo()
    {
        return $this->hasOne(Cargo::class,'id','cargo_id');
    }

}
