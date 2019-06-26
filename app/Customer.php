<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class Customer extends ESLModel
{
    protected $table = 'Client';
    protected $connection = 'sqlsrv2';
    protected $primaryKey = 'DCLink';
    public $timestamps = false;

    protected $fillable = ['DCLink','Account','AccountTerms','iAgeingTermID','Physical1','iCurrencyID',
'bForCurAcc','Physical2','Email','Contact_Person','Name','Telephone'];
}