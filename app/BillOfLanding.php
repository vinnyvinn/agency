<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class BillOfLanding extends ESLModel
{
 public function getDates()
{
    return [];
}
//    protected $dateFormat = 'Y-m-d H:i:s';
    protected  $guarded = [];

    public function vessel()
    {
        return $this->hasOne(Vessel::class,'id','vessel_id');
    }

    public function inWard()
    {
        return $this->hasOne(SavedInWard::class);
    }

    public function quote()
    {
        return $this->hasOne(Quotation::class, 'id', 'quote_id');
    }

    public function customer()
    {
        return $this->hasOne(Customer::class, 'DCLink','Client_id');
    }

    public function consignee()
    {
        return $this->hasOne(Consignee::class, 'id','consignee_id');
    }

    public function cargo()
    {
        return $this->hasMany(Cargo::class,'id','cargo_id');
    }

    public function sof()
    {
        return $this->hasMany(Sof::class,'bill_of_landing_id','id');
    }
}
