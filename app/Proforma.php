<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class Proforma extends ESLModel
{
    protected  $fillable = ['user_id','lead_id','project_id','currency','approved_by',
        'consignee_id','service_type_id','remittance','status'];

    public function consignee()
    {
        return $this->hasOne(Consignee::class,'id','consignee_id');
    }

    public function customer()
    {
        return $this->hasOne(Customer::class, 'DCLink','lead_id');
    }

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function services()
    {
        return $this->hasMany(QuotationService::class,'quotation_id','id');
    }
}
