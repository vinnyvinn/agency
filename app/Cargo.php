<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class Cargo extends ESLModel
{
    protected $fillable = ['name','lead_id','quotation_id','good_type_id','manifest_number','type','seal_no',
        'container_id','case_qty','t_net_weight','volume','container_size','load_status',
        't_gross_weight','shipping_line','discharge_rate','hs_no','bl_no',
        'port_stay','shipping_type','description','package','weight',
        'total_package','shipper','notifying_address','remarks'];

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







