<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'Client';
    protected $connection = 'sqlsrv2';
    public $timestamps = false;

    protected $guarded = [];
}
