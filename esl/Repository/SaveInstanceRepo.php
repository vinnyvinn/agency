<?php
/**
 * Created by PhpStorm.
 * User: marvin
 * Date: 3/27/18
 * Time: 8:05 AM
 */

namespace Esl\Repository;


use App\QuotationLog;

class SaveInstanceRepo
{
    public static function init()
    {
        return new self;
    }

    public function Quotation($id,$details)
    {
        QuotationLog::create([
            'quotation_id' => $id,
            'details' => json_encode($details)
        ]);

        return $this;
    }
}