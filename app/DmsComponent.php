<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class  DmsComponent extends ESLModel
{
    protected  $fillable = ['bill_of_landing_id','stage_component_id','doc_links','text','subchecklist'];

    public function scomponent()
    {
        return $this->hasOne(StageComponent::class,'id','stage_component_id');
    }
}
