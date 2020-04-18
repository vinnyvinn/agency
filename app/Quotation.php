<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class Quotation extends ESLModel
{
    protected $guarded = [];
    public function vessel()
    {
        return $this->hasOne(Vessel::class, 'id','vessel_id');
    }

    public function dms()
    {
        return $this->hasOne(BillOfLanding::class,'quote_id','id');
    }

    public function purchaseOrder()
    {
        return $this->hasMany(PurchaseOrder::class);
    }

    public function pettyCash()
    {
        return $this->hasMany(PettyCash::class);
    }

    public function lead()
    {
        return $this->hasOne(Client::class, 'DCLink','client_id');
    }

    public function services()
    {
        return $this->hasMany(QuotationService::class,'quotation_id','id');
    }

    public function cargos()
    {
        return $this->hasMany(Cargo::class, 'quotation_id','id');
    }

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    public function approvedBy()
    {
        return $this->hasOne(User::class,'id','approved_by');
    }

    public function checkedBy()
    {
        return $this->hasOne(User::class,'id','checked_by');
    }

    public function voyage()
    {
        return $this->hasOne(Voyage::class,'quotation_id','id');
    }

    public function consignee()
    {
        return $this->hasOne(Consignee::class,'cargo_id','id');
    }
    public function parties()
    {
        return $this->hasOne(NotifyingParty::class,'quotation_id','id');
    }

    public function remarks()
    {
        return $this->hasMany(Remarks::class, 'quotation_id','id');
    }

    public function logs()
    {
        return $this->hasMany(QuotationLog::class,'quotation_id','id');
    }
    public function client(){
        return $this->belongsTo(Client::class,'client_id','DCLink');
    }

}
