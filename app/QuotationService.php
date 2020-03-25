<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class QuotationService extends ESLModel
{
    protected $guarded = [];

    public function tariff()
    {
        return $this->hasOne(Tariff::class,'id','tariff_id');
    }
}
