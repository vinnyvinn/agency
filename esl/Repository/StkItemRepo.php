<?php
/**
 * Created by PhpStorm.
 * User: marvin
 * Date: 4/12/18
 * Time: 2:47 PM
 */

namespace Esl\Repository;


use App\StkItem;

class StkItemRepo
{
    public static function init()
    {
        return new self;
    }

    public function insertService($data)
    {
        $items = StkItem::where('Description_2','like','%'.$data['name'].'%')->get();

        if (count($items) > 1){
            $item = $items->last()->StockLink;
        }
        else{
            $item = StkItem::insertGetId(
                [
                    'AveUCst' => 0,
                    'BomCode' => null,
                    'Code' => count(StkItem::all()) + 1,
                    'Description_1' => $data['type'],
                    'Description_2' => $data['name'],
                    'Description_3' => '',
                    'DuplicateSN' => 0,
                    'HigUCst' => 0,
                    'ItemActive' => 1,
                    'JobQty' => 0,
                    'LatUCst' => 0,
                    'LowUCst' => 0,
                    'MFPQty' => 0,
                    'Max_Lvl' => 0,
                    'Min_Lvl' => 0,
                    'PMtrxCol' => 0,
                    //quantity
                    'QtyOnPO' => 0,
                    'QtyOnSO' => 0,
                    'Qty_On_Hand' => 0,
                    'Re_Ord_Lvl' => 0,
                    'Re_Ord_Qty' => 0,
                    'ReservedQty'=> 0,
                    'SMtrxCol' => 0,
                    'SerialItem' => 0,
                    'ServiceItem' => 1,
                    'StdUCst' => 0,
                    'StkItem_Checksum'=>0,
//                'StkItem_dCreatedDate',
//                'StkItem_dModifiedDate',
//                'StkItem_fLeadDays',
//                'StkItem_iBranchID',
//                'StkItem_iChangeSetID',
//                'StkItem_iCreatedAgentID',
//                'StkItem_iCreatedBranchID',
//                'StkItem_iModifiedAgentID',
//                'StkItem_iModifiedBranchID',
                    'StrictSN'=> 1,
                    'TTC' => 5,
                    'TTG' => 3,
                    'TTI' => 1,
                    'TTR' => 2,
                    'WhseItem' => 0,
//                'bAirtimeItem',
//                'bAllowNegStock',
                    'bCommissionItem' => 1,
//                'bDimensionItem',
                    'bLotItem' => 0,
                    'bLotMustExpire' => 0,
//                'bOverrideSell',
//                'bSyncToSOT',
//                'bUOMItem',
//                'bVASItem',
//                'cBuyUnit',
//                'cBuyWeight',
//                'cEachDescription',
                    'cExtDescription' => $data['name'].' service',
//                'cMeasurement',
//                'cSellUnit',
//                'cSellWeight',
                    'cSimpleCode' => mb_strimwidth($data['name'],0,1).'0'.(count(StkItem::all()) + 1),
//                'fBuyArea',
//                'fBuyHeight',
//                'fBuyLength',
//                'fBuyVolume',
//                'fBuyWidth',
//                'fIBTQtyToIssue',
//                'fIBTQtyToReceive',
//                'fItemLastGRVCost',
//                'fNetMass',
//                'fQtyToDeliver',
//                'fSellArea',
//                'fSellHeight',
//                'fSellLength',
//                'fSellVolume',
//                'fSellWidth',
//                'fStockGPPercent',
//                'iBuyingAgentID',
//                'iEUCommodityID',
//                'iEUSupplementaryUnitID',
//                'iInvSegValue1ID',
//                'iInvSegValue2ID',
//                'iInvSegValue3ID',
//                'iInvSegValue4ID',
//                'iInvSegValue5ID',
//                'iInvSegValue6ID',
//                'iInvSegValue7ID',
//                'iItemCostingMethod',
//                'iLotStatus' => 0,
//                'iUOMDefPurchaseUnitID',
//                'iUOMDefSellUnitID',
//                'iUOMStockingUnitID'
                ]
            );
        }

        return $item;
    }
}