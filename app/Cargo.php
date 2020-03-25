<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class Cargo extends ESLModel
{
    protected $guarded = [];

    public function quotation()
    {
        return $this->hasOne(Quotation::class, 'id', 'quotation_id');
    }

    public function consignee()
    {
        return $this->hasOne(Consignee::class,'cargo_id', 'id');
    }

    public function goodType()
    {
        return $this->hasOne(GoodType::class, 'id','good_type_id');
    }
}







