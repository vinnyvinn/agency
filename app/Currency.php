<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $connection = 'sqlsrv2';
    //protected $primaryKey = '';
     protected $table = 'Currency';
}
