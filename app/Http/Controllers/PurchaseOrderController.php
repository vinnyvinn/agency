<?php

namespace App\Http\Controllers;

use App\BillDetail;
use App\BillHeader;
use App\BtnLine;
use App\InvNum;
use App\PurchaseOrder;
use App\PurchaseOrderLine;
use App\Project;
use App\Quotation;
use App\QuotationService;
use App\ServiceTax;
use App\StkItem;
use App\Supplier;
use Carbon\Carbon;
use Esl\helpers\Constants;
use Esl\Repository\CurrencyRepo;
use Esl\Repository\CustomersRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use DB;

class PurchaseOrderController extends Controller
{
    public function generatePo($quotation_id)
    {
        $year_now = new Carbon(Carbon::now());
        $po_count = PurchaseOrder::whereYear('created_at',$year_now->year)->count() +1;

        $quotation = Quotation::with(['services'])->find($quotation_id);

        $getSageItems = StkItem::where('ServiceItem',1)->get()->sortBy('Description_2');

        $getQuotationItems = [];

        foreach ($quotation->services as $service){
            if (!in_array($service->stock_link, $getQuotationItems)){
                array_push($getQuotationItems,$service->stock_link);
            }
        }
//        $getQuotationItems = StkItem::whereIn('StockLink', $getStkItemToExclude)->get();

        return view('po.generate-po')
            ->withPoNumber($po_count)
            ->withSservices($getSageItems)
            ->withQuotation($quotation)
            ->withQitem($getQuotationItems)
            ->withTaxs(ServiceTax::all()->sortBy('Description'))
            ->withExrate(CurrencyRepo::init()->exchangeRate());
    }

    public function searchSupplier(Request $request)
    {
        $search_result = CustomersRepo::customerInit()
            ->searchCustomers($request->search_item, 'Vendor');

        $output = "<ul>";
        foreach ($search_result as $item){

            $output .= '<li style="list-style-type:none;" 
            onclick="fillData('.$item->DCLink.')">'. ucwords($item->Name). ' | <b>Account Type</b> : ' . ($item->iCurrencyID == 1 ? 'USD' : 'KES') .
                '  <span><button class="btn btn-xs btn-primary"><i class="fa fa-check"></i></button></span></li>';
        }
        $output."</ul>";

        return Response(['output' => $output]);
    }

    public function showPurchaseOrder($purchase_order_id)
    {
        $purchaseOrder = PurchaseOrder::find($purchase_order_id);

        return view('po.preview')
            ->withPo($purchaseOrder);
    }

    public function getVendor($id)
    {
        return Response(['vendor'=>Supplier::findOrFail($id)]);
    }

    public function addPurchaseOrder(Request $request)
    {
       //dd($request->all());
        $now = Carbon::now();

        $purchaseOrder = PurchaseOrder::create([
            'user_id' => Auth::id(),
            'quotation_id' => $request->po_detail['quotation_id'],
            'project_id' => $request->po_detail['project_id'] ? $request->po_detail['project_id'] : Project::first()->first()->ProjectLink,
            'supplier_id' => $request->po_detail['supplier_id'] ? $request->po_detail['supplier_id'] : Supplier::first()->DCLink,
            'input_currency' => $request->inputCur,
            'status' => Constants::PO_REQUEST,
            'po_date' => Carbon::parse($request->po_detail['po_date']),
            'po_no' => $request->po_detail['po_no'].'/'. $now->format('y')
        ]);



        foreach ($request->polines as $poline){
            PurchaseOrderLine::create(array(
              'purchase_order_id' => $purchaseOrder->id,
                'description' => $poline['description'],
                'qty'  => $poline['qty'],
                'rate' => (float) $poline['rate'],
                'total_amount' => (float) $poline['total'],
                'created_at' => $now,
                'updated_at' => $now,
                'tax_code' => $poline['tax_code'],
                'stock_link' => $poline['stock_link'],
                'tax_description' => $poline['tax_description'],
                'tax_id' => $poline['tax_id'],
                'tax' => (float)$poline['tax']
            ))  ;
        }




        Mail::to(['email'=>'francis.opalo@esl-eastafrica.com'])
            ->cc(Constants::EMAILS_CC)
            ->send(new \App\Mail\PurchaseOrder(['message'=>'Purchase Order '.$purchaseOrder->po_no.
                ' has been created by '. ucwords(Auth::user()->name) .
                ' on '.Carbon::now()->format('d-M-y H:m').
                '. Kindly prepare view and act accordingly ','po_number' => $purchaseOrder->po_no,'po_id' => $purchaseOrder->id],
                'Purchase Order '. strtoupper($purchaseOrder->po_no) . ' created'));

        alert()->success('Purchase Order generated successfully','Success');

        return response(['dms' => $purchaseOrder->quotation->dms->id]);

    }

    public function makeInvoice($po)
    {
//        dd($po->quotation->cargo->consignee_name);
        $lines = $po->polines;


//
        $invumID = InvNum::create(
            [
                //dclink
                'AccountID' => $po->supplier->DCLink,
                'Address1' => $po->supplier->Physical1,
                'Address2' => $po->supplier->Physical2,
                'Address3' => $po->supplier->Physical3,
                'Address4' => $po->supplier->Physical3,
                'Address5' => $po->supplier->Physical4,
                //extra fields
                'ucIDInvBLNo' => null,
                'ucIDInvVoyageNo' => $po->quotation->voyage_no,
                'ucIDInvVessel' => $po->quotation->vessel->name,
                'ucIDInvQty' => null, //tonnes measurementv
                'ucIDInvConsignee' => null,
                'ucIDInvClientRef' => null,
                //end
                'Address6' => $po->supplier->Physical5,
//            'DelMethodID',
                'DeliveryDate' => Carbon::now(),
//            'DeliveryNote',
                'Description' => 'Purchase Order ' , //po
                'DocFlag' => 0,
                'DocRepID' => 0,
                'DocState' => 1,
                'DocType' => 5, //5
                'DocVersion' => 1,
                'DueDate' => Carbon::now(),
//            'Email_Sent',
//            'ExtOrderNum',
                //from client TODO:client iccurency id
                'ForeignCurrencyID' => $po->supplier->iCurrencyID == 1 ? 1 : 0,
//            'GrvSplitFixedAmnt',
//            'GrvSplitFixedCost',
                'InvDate' => Carbon::now(),
//            'InvDisc',
//            'InvDiscAmnt',
//            'InvDiscAmntEx',
//            'InvDiscReasonID',
//            'InvNum_Checksum',
//            'InvNum_dCreatedDate',
//            'InvNum_dModifiedDate',
//            'InvNum_iBranchID',
//            'InvNum_iChangeSetID',
//            'InvNum_iCreatedAgentID',
//            'InvNum_iCreatedBranchID',
//            'InvNum_iModifiedAgentID',
//            'InvNum_iModifiedBranchID',
                'InvNumber' => 'LPO00'.(count(InvNum::all())+1), //
                //total invoice line
                'InvTotExcl' => $po->supplier->iCurrencyID == 1 ? ($lines->sum('total_amount') * CurrencyRepo::init()->exchangeRate()) : $lines->sum('total_amount'), //KES
                'InvTotExclDEx' => $po->supplier->iCurrencyID == 1 ? ($lines->sum('total_amount') * CurrencyRepo::init()->exchangeRate()) : $lines->sum('total_amount'),
                'InvTotIncl' => $po->supplier->iCurrencyID == 1 ? ($lines->sum('total_amount') * CurrencyRepo::init()->exchangeRate()) : $lines->sum('total_amount'),
                'InvTotInclDEx' => $po->supplier->iCurrencyID == 1 ? ($lines->sum('total_amount') * CurrencyRepo::init()->exchangeRate()) : $lines->sum('total_amount'),
                'InvTotInclExRounding' => $po->supplier->iCurrencyID == 1 ? ($lines->sum('total_amount') * CurrencyRepo::init()->exchangeRate()) : $lines->sum('total_amount'),
//            'InvTotRounding',
                'InvTotTax' => 0,
                'InvTotTaxDEx' => 0,
//            'KeepAsideCollectionDate',
//            'KeepAsideExpiryDate',
//            'Message1',
//            'Message2',
//            'Message3',
//            'OrdDiscAmnt',
//            'OrdDiscAmntEx',
                'OrdTotExcl' => $po->supplier->iCurrencyID == 1 ? ($lines->sum('total_amount') * CurrencyRepo::init()->exchangeRate()) : $lines->sum('total_amount'),
                'OrdTotExclDEx' => $po->supplier->iCurrencyID == 1 ? ($lines->sum('total_amount') * CurrencyRepo::init()->exchangeRate()) : $lines->sum('total_amount'),
                'OrdTotIncl' => $po->supplier->iCurrencyID == 1 ? ($lines->sum('total_amount') * CurrencyRepo::init()->exchangeRate()) : $lines->sum('total_amount'),
                'OrdTotInclDEx' => $po->supplier->iCurrencyID == 1 ? ($lines->sum('total_amount') * CurrencyRepo::init()->exchangeRate()) : $lines->sum('total_amount'),
                'OrdTotInclExRounding' => $po->supplier->iCurrencyID == 1 ? ($lines->sum('total_amount') * CurrencyRepo::init()->exchangeRate()) : $lines->sum('total_amount'),
//            'OrdTotRounding',
                'OrdTotTax' => 0,
                'OrdTotTaxDEx' => 0,
                'OrderDate' => Carbon::now(),
//            'OrderNum',
//            'OrderPriorityID',
//            'OrderStatusID',
                'OrigDocID' => 0,
                'PAddress1' => $po->supplier->Physical1,
                'PAddress2' => $po->supplier->Physical2,
                'PAddress3' => $po->supplier->Physical3,
                'PAddress4' => $po->supplier->Physical4,
                'PAddress5' => $po->supplier->Physical5,
                'PAddress6' => $po->supplier->Physical5,
//            'POSAmntTendered',
//            'POSChange',
                'ProjectID' => $po->quotation->project_id, //UPDATE PROJECT ID
                'TaxInclusive' => 0,
//              'TillID',
                'bInvRounding' => 1,
//            'bIsDCOrder',
//            'bLinkedTemplate',
                'bTaxPerLine' => 1,
//            'bUseFixedPrices',
                'cAccountName' => $po->supplier->Name, //VENDOR NAME
//            'cAuthorisedBy',
//            'cCellular',
//            'cClaimNumber',
//            'cContact',
//            'cEmail',
//            'cExcessAccCont1',
//            'cExcessAccCont2',
//            'cExcessAccName',
//            'cFax',
//            'cGIVNumber',
//            'cPolicyNumber',
//            'cSettlementTermInvMsg',
//            client pin number
//            'cTaxNumber',
//            'cTelephone',
//            'dIncidentDate',
//            'fAddChargeExclusive',
//            'fAddChargeExclusiveForeign',
//            'fAddChargeInclusive',
//            'fAddChargeInclusiveForeign',
//            'fAddChargeTax',
//            'fAddChargeTaxForeign',
//            'fDepositAmountForeign',
//            'fDepositAmountNew',
//            'fDepositAmountTotal',
//            'fDepositAmountTotalForeign',
//            'fDepositAmountUnallocated',
//            'fDepositAmountUnallocatedForeign',
//            'fExcessAmt',
//            'fExcessExclusive',
//            'fExcessInclusive',
//            'fExcessPct',
//            'fExcessTax',
                'fExchangeRate' => CurrencyRepo::init()->exchangeRate(),
//            'fGrvSplitFixedAmntForeign',
//            'fInvDiscAmntExForeign',
//            'fInvDiscAmntForeign',
                'fInvTotExclDExForeign' => $po->supplier->iCurrencyID == 1 ? $lines->sum('total_amount') : null,
                'fInvTotExclForeign' => $po->supplier->iCurrencyID == 1 ? $lines->sum('total_amount') : null,
//            'fInvTotForeignRounding',
                'fInvTotInclDExForeign' => $po->supplier->iCurrencyID == 1 ? $lines->sum('total_amount') : null,
                'fInvTotInclForeign' => $po->supplier->iCurrencyID == 1 ? $lines->sum('total_amount') : null,
//            'fInvTotInclForeignExRounding',
                'fInvTotTaxDExForeign' => 0,
                'fInvTotTaxForeign' => 0,
//            'fOrdAddChargeExclusive',
//            'fOrdAddChargeExclusiveForeign',
//            'fOrdAddChargeInclusive',
//            'fOrdAddChargeInclusiveForeign',
//            'fOrdAddChargeTax',
//            'fOrdAddChargeTaxForeign',
//            'fOrdDiscAmntExForeign',
//            'fOrdDiscAmntForeign',
                'fOrdTotExclDExForeign' =>  $po->supplier->iCurrencyID == 1 ? $lines->sum('total_amount') : null,
                'fOrdTotExclForeign' =>  $po->supplier->iCurrencyID == 1 ? $lines->sum('total_amount') : null,
//            'fOrdTotForeignRounding',
                'fOrdTotInclDExForeign' =>  $po->supplier->iCurrencyID == 1 ? $lines->sum('total_amount') : null,
                'fOrdTotInclForeign' =>  $po->supplier->iCurrencyID == 1 ? $lines->sum('total_amount') : null,
//            'fOrdTotInclForeignExRounding',
                'fOrdTotTaxDExForeign' => 0,
                'fOrdTotTaxForeign' => 0,
//            'fRefundAmount',
//            'fRefundAmountForeign',
//            'iDCBranchID',
//            'iDocEmailed',
//            'iDocPrinted',
//            'iEUNoTCID',
                'iINVNUMAgentID' => 1,
//            'iInsuranceState',
//            'iInvSettlementTermsID',
//            'iInvoiceSplitDocID',
//            'iLinkedDocID',
//            'iMergedDocID',
//            'iOpportunityID',
//            'iOrderCancelReasonID',
//            'iPOAuthStatus',
//            'iPOIncidentID',
//            'iProspectID',
//            'iSalesBranchID',
//            'iSupervisorID',
//            'imgOrderSignature'
              'ucIDPOrdVessel' => $po->quotation->vessel ? $po->quotation->vessel->name : '',
              'ucIDPOrdVoyageNo' => $po->quotation->voyage ? $po->quotation->voyage->voyage_no : '',
                'ucIDPOrdConsignee' => $po->quotation->consignee ? $po->quotation->consignee->consignee_name : '',
                'ucIDPOrdBLNo' => $po->quotation->cargos ? $po->quotation->cargos->first()->name :'',
                'ucIDPOrdPreparedBy' => $po->user ? $po->user->name : '',
                'ucIDPOrdApprovedBy' => Auth::user()->name,

            ]

        );

        $inv_id = InvNum::orderBy('InvDate','DESC')->first()->AutoIndex;

        self::makeInvoiceLines($lines = $po->polines, $inv_id, $po);

        //return $invumID;
        return true;
    }

    public function approvePurchaseOrder($purchase_order_id)
    {
        $po = PurchaseOrder::find($purchase_order_id);
        $quote = Quotation::find($po->quotation_id);
        $date = Carbon::now()->format('yy-m-d');
        $bill_header = BillHeader::create([
            'QUOTE_NO' => $quote->crm_ref,
            'OPERATION_APP' => env('DB_DATABASE_2'),
            'OPERATION_NO' => $quote->internal_ref,
            'DOC_TYPE' => 'PURCHASE ORDER',
            'INVOICE_DATE' => $date,
            'PROJECT_ID' => $quote->project_int,
            'CUST_ID' => $quote->DCLink,
            'STATUS' => 'UNPOSTED',
            'SAGE_INV_NO' => ''
        ]);
        foreach ($po->polines as $service){
            $bill_details = BillDetail::create([
                'DEPT_NAME' => 'FORWARDING',
                'ITEM_ID' => $service->stock_link,
                'HEADER_ID' => $bill_header->SNo,
                'ITEM_DESC' => $service->name,
                'ITEM_QTY' => $service->qty,
                'UNIT_PRICE_EXCL' =>round((float)$service->rate,2),
                'VAT' => $service->tax,
                'UNIT_COST' => round((float)$service->rate,2),
                'DOC_TYPE' => 'INVOICE',
                'STATUS' => 'UNPOSTED',
                'AP_ID' => $po->supplier_id
            ]);
        }
       // $invnum_id = $this->makeInvoice($po);
      //  $po->invnum_id = $invnum_id;
        $po->status = Constants::PO_APPROVED;
        $po->approved_by = Auth::id();
        $po->save();

        $getStkItems = [];

        foreach ($po->quotation->services as $service){
            if (!in_array($service->stock_link, $getStkItems)){
                array_push($getStkItems,$service->stock_link);
            }
        }

        foreach ($po->polines as $poline){
            if (in_array($poline->stock_link,$getStkItems)){
                $poline->in_quotation = true;
                $poline->save();

                $qservice = QuotationService::where('stock_link',$poline->stock_link)->get();

                if (count($qservice) > 0){
                    $qservice = $qservice->first();
                    $qservice->buying_price = $qservice->buying_price + $poline->total_amount;
                    $qservice->save();
                }

            }
        }

        Mail::to(['email'=>'accounts@esl-eastafrica.com'])
            ->cc(Constants::EMAILS_CC)
            ->send(new \App\Mail\PurchaseOrder(['message'=>'Purchase Order '.$po->po_no.
                ' has been approved by '. ucwords(Auth::user()->name) .
                ' on '.Carbon::now()->format('d-M-y H:m').
                '. Kindly prepare in advance ','po_number' => $po->po_no,'po_id' => $po->id],
                'Agency Purchase Order '. strtoupper($po->po_no) . ' APPROVED'));

        alert()->success('Approved','Approved Successfully');

        return back();
    }

    public function disapprovePurchaseOrder($purchase_order_id)
    {
        $po = PurchaseOrder::find($purchase_order_id);
        $po->status = Constants::PO_DISAPPROVED;
        $po->approved_by = Auth::id();
        $po->save();

        alert()->success('Disapproved','Disapproved Successfully');

        return back();
    }

    private function makeInvoiceLines($lines, $invumid, $po)
    {




        foreach ($lines as $line){

            BtnLine::create(array(
//            '_btblInvoiceLines_Checksum',
//            '_btblInvoiceLines_dCreatedDate',
//            '_btblInvoiceLines_dModifiedDate',
//            '_btblInvoiceLines_iBranchID',
//            '_btblInvoiceLines_iChangeSetID',
//            '_btblInvoiceLines_iCreatedAgentID',
//            '_btblInvoiceLines_iCreatedBranchID',
//            '_btblInvoiceLines_iModifiedAgentID',
//            '_btblInvoiceLines_iModifiedBranchID',
                'bChargeCom' => 1,
//            'bIsLotItem',
//            'bIsSerialItem',
//            'bIsWhseItem',
//            'bPromotionApplied',
                'cDescription' => $line->description,
//            'cLineNotes',
//            'cLotNumber',
//            'cPromotionCode',
//            'cTradeinItem',
                'dDeliveryDate' => $line->created_at,
//            'dLotExpiryDate',
//            'fAddCost',
//            'fAddCostForeign',
//            'fHeight',
//            'fLength',
//            'fLineDiscount',
//            'fPromotionPriceExcl',
//            'fPromotionPriceIncl',
//            'fQtyChange',
//            'fQtyChangeLineTaxAmount',
//            'fQtyChangeLineTaxAmountForeign',
//            'fQtyChangeLineTaxAmountNoDisc',
//            'fQtyChangeLineTaxAmountNoDiscForeign',
//            'fQtyChangeLineTotExcl',
                'fQtyDeliver'=>$line->qty,
                'fQtyDeliverUR'=>$line->qty,
                'fQtyForDelivery' => $line->qty,
                'fQtyForDeliveryUR' => $line->qty,
                //qty
                'fQtyLastProcess' => 0,
                'fQtyLastProcessLineTaxAmount' => 0,
                'fQtyLastProcessLineTaxAmountForeign'=>0,
                'fQtyLastProcessLineTaxAmountNoDisc' => 0,
                'fQtyLastProcessLineTaxAmountNoDiscForeign'=>0,
                'fQtyLastProcessLineTotExcl' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQtyLastProcessLineTotExclForeign' =>$po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQtyLastProcessLineTotExclNoDisc' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQtyLastProcessLineTotExclNoDiscForeign' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQtyLastProcessLineTotIncl' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQtyLastProcessLineTotInclForeign' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQtyLastProcessLineTotInclNoDisc' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQtyLastProcessLineTotInclNoDiscForeign' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQtyLastProcessUR' => $line->qty,
                'fQtyLinkedUsed' => $line->qty,
                'fQtyLinkedUsedUR' => $line->qty,
                //qty
                'fQtyProcessed' => 0,
                'fQtyProcessedLineTaxAmount' => 0,
                'fQtyProcessedLineTaxAmountForeign' => 0,
                'fQtyProcessedLineTaxAmountNoDisc' => 0,
                'fQtyProcessedLineTaxAmountNoDiscForeign' => 0,
                'fQtyProcessedLineTotExcl' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQtyProcessedLineTotExclForeign' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQtyToProcessLineTotExclNoDisc' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQtyToProcessLineTotExclNoDiscForeign' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQtyToProcessLineTotIncl' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQtyToProcessLineTotInclForeign' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQtyToProcessLineTotInclNoDisc' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQtyToProcessLineTotInclNoDiscForeign' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQtyToProcessUR' => $line->qty,
                //quantity
                'fQuantity' => $line->qty,
                'fQuantityLineTaxAmount' => 0,
                'fQuantityLineTaxAmountForeign' => 0,
                'fQuantityLineTaxAmountNoDisc' => 0,
                'fQuantityLineTaxAmountNoDiscForeign' => 0,
                'fQuantityLineTotExcl' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQuantityLineTotExclForeign' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQuantityLineTotExclNoDisc' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQuantityLineTotExclNoDiscForeign' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQuantityLineTotIncl' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQuantityLineTotInclForeign' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQuantityLineTotInclNoDisc' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQuantityLineTotInclNoDiscForeign' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQuantityUR' => $line->qty,
                'fTaxRate' => 0,
                'fUnitCost' =>$po->supplier->iCurrencyID == 1 ? ($line->rate * CurrencyRepo::init()->exchangeRate()) : $line->rate,
                'fUnitCostForeign' => $po->supplier->iCurrencyID == 1 ? $line->rate : 0,
                //price single
                'fUnitPriceExcl' => $po->supplier->iCurrencyID == 1 ? ($line->rate * CurrencyRepo::init()->exchangeRate()) : $line->rate,
                'fUnitPriceExclForeign' => $po->supplier->iCurrencyID == 1 ? $line->rate : 0,
//            'fUnitPriceExclForeignOrig',
//            'fUnitPriceExclOrig',
                'fWidth',
//            'iDeliveryMethodID',
//            'iDeliveryStatus',
//            'iGrvLineID',
                'iInvoiceID' => $invumid,
//            'iJobID',
//            'iLedgerAccountID',
//            'iLineDiscountReasonID',
//            'iLineDocketMode',
                'iLineID' => 1,
                'iLineProjectID' => null,
                'iLineRepID' => null,
//            'iLinkedLineID',
//            'iLotID',
//            'iMFPID',
                'iModule' => 0,
//            'iOrigLineID',
//            'iPieces',
//            'iPiecesDeliver',
//            'iPiecesForDelivery',
//            'iPiecesLastProcess',
//            'iPiecesLinkedUsed',
//            'iPiecesProcessed',
//            'iPiecesReserved',
//            'iPiecesToProcess',''
//            'iPriceListNameID' => ,
//            'iReturnReasonID',
//            'iSOLinkedPOLineID',
//            'iSalesWhseID',
                //item id9
                'iStockCodeID' => $line->stock_link,
                'iTaxTypeID' => $line->tax_id,
//            'iUnitPriceOverrideReasonID',
//            'iUnitsOfMeasureCategoryID',
//            'iUnitsOfMeasureID',
//            'iUnitsOfMeasureStockingID',
//            'iWarehouseID',
                'ucIDPOrdVoyageNo' => $po->quotation->vessel ? $po->quotation->vessel->name : '',
                'ucIDPOrdVessel' => $po->quotation->voyage ? $po->quotation->voyage->voyage_no : '',
                'ucIDPOrdConsignee' => '',
               'ucIDPOrdBLNo' => $po->quotation->cargos ? $po->quotation->cargos()->first()->bl_no : ''
            ));

        }



        return true;


    }
}
