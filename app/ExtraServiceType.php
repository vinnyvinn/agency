<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class ExtraServiceType extends ESLModel
{
    protected $fillable = ['name','description'];
}
