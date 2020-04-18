<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class SavedInWard extends ESLModel
{
    protected $fillable = ['bill_of_landing_id','data'];

    public function dms()
    {
        return $this->belongsTo(BillOfLanding::class,'bill_of_landing_id','id');
    }
}
