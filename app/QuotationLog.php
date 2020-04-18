<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class QuotationLog extends ESLModel
{
    protected $fillable = ['quotation_id','details'];
}
