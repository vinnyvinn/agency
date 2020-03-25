<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class Vessel extends ESLModel
{
    protected $guarded = [];

    public function lead()
    {
        return $this->hasMany(Client::class, 'DCLink','client_id');
    }

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = strtoupper($name);
    }

    public function vDocs()
    {
        return $this->hasMany(VesselDocs::class,'vessel_id','id');
    }
}
