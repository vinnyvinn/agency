<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    protected $table = 'WIZ_ESL_BILL_DETAILS';
    protected $primaryKey = 'SNo';
    protected $connection = 'sqlsrv2';
    protected  $guarded = [];
    public $timestamps = false;
}
