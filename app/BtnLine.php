<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BtnLine extends Model
{
//    protected $dateFormat = 'Y-m-d H:i:s';
   protected $fillable= ['_btblInvoiceLines_Checksum','bChargeCom','cDescription','dDeliveryDate','fQtyChange','fQtyDeliver','fQtyDeliverUR','fQtyForDelivery','fQtyForDeliveryUR',
       'fQtyLastProcess','fQtyLastProcessLineTaxAmount','fQtyLastProcessLineTaxAmountForeign','fQtyLastProcessLineTaxAmountNoDisc','fQtyLastProcessLineTaxAmountNoDiscForeign',
       'fQtyLastProcessLineTotExcl','fQtyLastProcessLineTotExclForeign','fQtyLastProcessLineTotExclNoDisc','fQtyLastProcessLineTotExclNoDiscForeign','fQtyLastProcessLineTotIncl',
       'fQtyLastProcessLineTotInclForeign','fQtyLastProcessLineTotInclNoDisc','fQtyLastProcessLineTotInclNoDiscForeign','fQtyLastProcessUR','fQtyLinkedUsed','fQtyLinkedUsedUR',
       'fQtyProcessed','fQtyProcessedLineTaxAmount','fQtyProcessedLineTaxAmountForeign','fQtyProcessedLineTaxAmountNoDisc','fQtyProcessedLineTaxAmountNoDiscForeign','fQtyProcessedLineTotExcl',
       'fQtyProcessedLineTotExclForeign','fQtyProcessedLineTotExclNoDisc','fQtyProcessedLineTotExclNoDiscForeign','fQtyProcessedLineTotIncl','fQtyProcessedLineTotInclForeign',
       'fQtyProcessedLineTotInclNoDisc','fQtyProcessedLineTotInclNoDiscForeign','fQtyProcessedUR','fQtyToProcess','fQtyToProcessLineTaxAmount','fQtyToProcessLineTaxAmountForeign',
       'fQtyToProcessLineTaxAmountNoDisc','fQtyToProcessLineTaxAmountNoDiscForeign','fQtyToProcessLineTotExcl','fQtyToProcessLineTotExclForeign','fQtyToProcessLineTotExclNoDisc',
       'fQtyToProcessLineTotExclNoDiscForeign','fQtyToProcessLineTotIncl','fQtyToProcessLineTotInclForeign','fQtyToProcessLineTotInclNoDisc','fQtyToProcessLineTotInclNoDiscForeign',
       'fQtyToProcessUR','fQuantity','fQuantityLineTaxAmount','fQuantityLineTaxAmountForeign','fQuantityLineTaxAmountNoDisc','fQuantityLineTaxAmountNoDiscForeign','fQuantityLineTotExcl',
       'fQuantityLineTotExclForeign','fQuantityLineTotExclNoDisc','fQuantityLineTotExclNoDiscForeign','fQuantityLineTotIncl','fQuantityLineTotInclForeign','fQuantityLineTotInclNoDisc',
       'fQuantityLineTotInclNoDiscForeign','fQuantityUR','fTaxRate','fUnitCost','fUnitCostForeign','fUnitPriceExcl','fUnitPriceExclForeign','fUnitPriceIncl','fUnitPriceInclForeign',
       'iInvoiceID','iLineID','iLineProjectID','iLineRepID','iModule','iStockCodeID','iTaxTypeID'];

    protected $table = '_btblInvoiceLines';
    protected $primaryKey = 'idInvoiceLines';
    protected $connection = 'sqlsrv2';
    public $timestamps = false;
}


//

//
