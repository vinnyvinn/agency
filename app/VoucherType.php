<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoucherType extends Model
{
    protected $connection = 'sqlsrv2';
    //protected $primaryKey = '';
    protected $table = 'PR_VoucherType';
    protected $fillable = ['iDeftStartNo'];
    public $timestamps = false;
}
