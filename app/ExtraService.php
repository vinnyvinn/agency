<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class ExtraService extends ESLModel
{
    protected $fillable = ['extra_service_type_id','stk_id','name','rate','unit'];

    public function type()
    {
        return $this->hasOne(ExtraServiceType::class,'id','extra_service_type_id');
    }
}
