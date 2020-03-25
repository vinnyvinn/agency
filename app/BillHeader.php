<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillHeader extends Model
{
    protected $table = 'WIZ_ESL_BILL_HEADER';
    protected $primaryKey = 'SNo';
    protected $connection = 'sqlsrv2';
    protected  $guarded = [];
    public $timestamps = false;
}
