<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvNum extends Model
{

    protected $fillable = ['AccountID','Address1','Address2','Address3','Address4','Address5','Address6','DeliveryDate','Description','DocFlag','DocRepID','DocState',
        'DocType','DocVersion','DueDate','ForeignCurrencyID','InvDate','InvNumber','InvTotExcl','InvTotExclDEx','InvTotIncl','InvTotInclDEx','InvTotInclExRounding',
        'InvTotTax','InvTotTaxDEx','OrdTotExcl','OrdTotExclDEx','OrdTotIncl','OrdTotInclDEx','OrdTotInclExRounding','OrdTotTax','OrdTotTaxDEx','OrderDate',
        'OrigDocID','PAddress1','PAddress2','PAddress3','PAddress4','PAddress5','PAddress6','ProjectID','TaxInclusive','bInvRounding','bTaxPerLine','cAccountName',
        'fExchangeRate','fInvTotExclDExForeign','fInvTotExclForeign','fInvTotInclDExForeign','fInvTotInclForeign','fInvTotTaxDExForeign','fInvTotTaxForeign','fOrdTotExclDExForeign',
        'fOrdTotExclForeign','fOrdTotInclDExForeign','fOrdTotInclForeign','fOrdTotTaxDExForeign','fOrdTotTaxForeign','iINVNUMAgentID','ucIDInvBLNo','ucIDInvVoyageNo',
        'ucIDInvVessel','ucIDInvQty','ucIDInvConsignee','ucIDInvClientRef','ucIDInvCargoType','ucIDInvCheckedBy'];

    protected $table = 'InvNum';
    protected $primaryKey = 'AutoIndex';
    protected $connection = 'sqlsrv2';
    public $timestamps = false;

}





