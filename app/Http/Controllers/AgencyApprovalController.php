<?php

namespace App\Http\Controllers;

use App\Mail\ApprovalRequest;
use App\Mail\QuotationUpdate;
use App\Quotation;
use App\User;
use Esl\helpers\Constants;
use Esl\Repository\AgencyRepo;
use Esl\Repository\NotificationRepo;
use Esl\Repository\QuotationRepo;
use Esl\Repository\RemarkRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AgencyApprovalController extends Controller
{
    public function approve(Request $request)
    {

        $quotation = Quotation::findOrFail($request->quotation_id);
        QuotationRepo::make()->changeStatus($request->quotation_id,
            Constants::LEAD_QUOTATION_APPROVED);
        $userEmail = User::findOrFail($quotation->user_id)->email;

        $quotation->approved_by = Auth::user()->id;
        $quotation->save();

        Mail::to([$userEmail])
//            ->cc(['evans@esl-eastafrica.com'])
            ->send(new QuotationUpdate([
                'url'=>'/quotation/'.$quotation->id,
                'message'=>'Your quotation has been Approved by '. ucwords(Auth::user()->name)]));

        NotificationRepo::create()->notification(Constants::Q_APPROVED_TITLE,
            Constants::Q_APPROVED_TEXT,
            '/quotation/'.$request->quotation_id,0,'Agency', $quotation->user_id)
        ->success('Approved successfully');

        self::updates([
            'quotation_id' => $request->quotation_id,
            'user_id' => $quotation->user_id,
            'remarks' => $request->remarks
        ], 'Approved');

        return Response(['success' => 'Approved']);
    }

    public function checked(Request $request)
    {
//        dd($request->all());
        $quotation = Quotation::findOrFail($request->quotation_id);
        QuotationRepo::make()->changeStatus($request->quotation_id,
            Constants::LEAD_QUOTATION_CHECKED);

        $quotation->checked_by = Auth::user()->id;
        $quotation->save();

        $userEmail = User::findOrFail($quotation->user_id)->email;

        Mail::to([$userEmail])
            ->send(new QuotationUpdate([
                'url'=>'/quotation/'.$quotation->id,
                'message'=>'Your quotation has been checked by '. ucwords(Auth::user()->name)]));

        Mail::to(['email'=>'maurine.atieno@esl-eastafrica.com'])
            ->cc(Constants::EMAILS_CC)
            ->send(new ApprovalRequest([
                'user' => Auth::user()->name,
                'url'=>'/quotation/view/'.$quotation->id],'Approval Request'));

        NotificationRepo::create()->notification(Constants::Q_CHECKED_TITLE,
            Constants::Q_CHECKED_TEXT,
            '/quotation/'.$request->quotation_id,0,'Agency', $quotation->user_id)
            ->success('Checked successfully');

        self::updates([
            'quotation_id' => $request->quotation_id,
            'user_id' => $quotation->user_id,
            'remarks' => $request->remarks
        ], 'Checked');

        return Response(['success' => 'Checked']);
    }

    public function revision(Request $request)
    {
        $quotation = Quotation::findOrFail($request->quotation_id);

        $quotation->approved_by = Auth::user()->id;
        $quotation->save();

        QuotationRepo::make()->changeStatus($request->quotation_id,
            Constants::LEAD_QUOTATION_DECLINED);

        $userEmail = User::findOrFail($quotation->user_id)->email;

        Mail::to([$userEmail])
            ->cc(['evans@esl-eastafrica.com'])
            ->send(new QuotationUpdate([
                'url'=>'/quotation/'.$quotation->id,
                'message'=>'Your quotation has been Disapproved by '. ucwords(Auth::user()->name)]));

        NotificationRepo::create()->notification(Constants::Q_DISAPPROVED_TITLE,
            Constants::Q_DISAPPROVED_TEXT,
            '/quotation/'.$request->quotation_id,0,'Agency', $quotation->user_id)
        ->message('Quotation disapproved','Disapproval');

        self::updates([
            'quotation_id' => $request->quotation_id,
            'user_id' => $quotation->user_id,
            'remarks' => $request->remarks
        ], 'Disapproved');

        return Response(['success' => 'Revision']);
    }

    private function updates($data, $action){
        AgencyRepo::make()->quotationApproval([
            'user_id' => Auth::user()->id,
            'quotation_id' => $data['quotation_id'],
            'quotation_action' => $action,
            'remarks' => $data['remarks'] == null ? '' : $data['remarks']
        ]);

        if ($data['remarks']){
        RemarkRepo::make()->remark([
            'user_id' => Auth::user()->id,
            'remark_to' => $data['user_id'],
            'quotation_id' => $data['quotation_id'],
            'remark' => $data['remarks']
        ]);}
    }

    public function addRemark(Request $request)
    {
        RemarkRepo::make()->remark([
            'user_id' => Auth::user()->id,
            'remark_to' => Auth::user()->id,
            'quotation_id' => $request->quotation_id,
            'remark' => $request->remarks
        ]);

        return Response(['success' => 'Approved']);
    }
}
