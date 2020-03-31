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

    public function service_item($quotation)
    {
        return $this->belongsTo(BillDetail::class,'stk_id','ITEM_ID')->where('quotation_id',$quotation)->first();
    }
}
