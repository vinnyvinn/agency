<?php

namespace App\Http\Controllers;

use App\PettyCash;
use App\Project;
use Carbon\Carbon;
use Esl\helpers\Constants;
use Esl\Repository\UploadFileRepo;
use Esl\Repository\CashRequestRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use DB;

class PettyCashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $filepath = ' ';
        if ($request->has('file_path')) {
            $filepath = UploadFileRepo::init()->upload($request->file_path);
        }

        PettyCash::create(
            [
                'quotation_id' => $request->quotation_id,
                'employee_number' => $request->employee_number,
                'user_id' => $request->user_id,
                'amount' => $request->amount,
                'currency_type' => $request->currency_type,
                'deadline' => Carbon::parse($request->deadline),
                'reason' => $request->reason,
                'file_path' => $filepath
            ]
        );


        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PettyCash  $pettyCash
     * @return \Illuminate\Http\Response
     */
    public function show(PettyCash $pettyCash)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PettyCash  $pettyCash
     * @return \Illuminate\Http\Response
     */
    public function edit(PettyCash $pettyCash)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PettyCash  $pettyCash
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PettyCash $pettyCash)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PettyCash  $pettyCash
     * @return \Illuminate\Http\Response
     */
    public function destroy(PettyCash $pettyCash)
    {
        //
    }

    public function approve($petty_cash_id)
    {


        $pettyCash = PettyCash::with(['quotation'])->find($petty_cash_id);

        $project = Project::find($pettyCash->quotation->project_id);
        $project_name= $project ? $project->ProjectName :'Not Set';
        CashRequestRepo::cashRequestInit()->fundRequest($pettyCash,$pettyCash->quotation->project_id);
        $pettyCash->status = 1;
        $pettyCash->save();
        $pettyCash->update(['status' => 1]);

         Mail::to(['email' => 'accounts@esl-eastafrica.com'])
             ->cc(Constants::EMAILS_CC)
             ->send(new \App\Mail\FundRequest([
                 'message' => 'Approved, Kindly issue KES ' . number_format($pettyCash->amount, 2) . ' to ' . ucwords($pettyCash->user->name) . ' for ' .
                     ucfirst($pettyCash->reason) . '. Project Name ' . $project_name, 'user' => Auth::user()->name
             ], $project));

        alert()->success('Successfully approved', 'Success');

        return redirect()->back();
    }
}
