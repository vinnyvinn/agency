<?php
/**
 * Created by PhpStorm.
 * User: marvin
 * Date: 2/7/18
 * Time: 8:23 PM
 */

namespace Esl\Repository;


use App\Quotation;
use App\QuotationService;

class QuotationServiceRepo
{
    public static function init()
    {
        return new self;
    }

    public function getQuotationServices($id)
    {
        $services = QuotationService::where('quotation_id', $id)->get();

        return [
            'services' => $services,
            'exc_total' => number_format(($services->sum('total') - $services->sum('tax'))),
            'total_tax' => number_format($services->sum('tax')),
            'inc_total' => number_format($services->sum('total'))
        ];
    }

}