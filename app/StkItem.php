<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StkItem extends Model
{
//    protected $dateFormat = 'Y-m-d H:i:s';
    protected $table = 'StkItem';
    protected $primaryKey = 'StockLink';
    protected $connection = 'sqlsrv2';
}
