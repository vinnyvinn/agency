<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PettyCash extends Model
{
    protected $fillable = ['quotation_id','employee_number','user_id','amount','deadline','reason','file_path','currency_type','payment_mode'];

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
