<?php

namespace App\Http\Controllers;

use App\Lead;
use App\Quotation;
use Carbon\Carbon;
use Esl\helpers\Constants;
use Esl\Repository\CustomersRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        dd(Constants::COUNTRY_LIST);

        return view('leads.index')
            ->withLeads(Lead::where('status',0)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        dd(json_decode(Constants::CURRENCY_ARRAY));
        return view('leads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $inserted = $request->has('client_id') ? $request->client_id : DB::connection('sqlsrv2')->table('_rtblProspect')->insertGetId([
//            'cCompanyName'=> mb_strimwidth($request->name, 4,10),
//            'cEmail'=> $request->email,
//            'cPhysicalAddress1'=> $request->cPhysicalAddress1,
//            'cPhysicalAddress2'=> $request->cPhysicalAddress2,
//            'cTelephone'=> $request->phone
//        ]);

        $data = $request->all();
        $data['prospect_id'] = $request->has('client_id') ? null : null;
        $data['client_id'] = $request->has('client_id') ? $request->client_id : null;
        $lead = Lead::create($data);
        return redirect('/leads/'.$lead->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function show(Lead $lead)
    {
        return view('leads.show')
            ->withLead($lead)
            ->withQuotations(Lead::with(['quotation.vessel'])->findOrFail($lead->id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function edit(Lead $lead)
    {
        return view('leads.edit')
            ->withLead($lead);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lead $lead)
    {
        //TODO:Update the prospect leader
//        if ($lead->prospect_id != null){
//            dd(DB::connection('sqlsrv2')->table('_rtblProspect')->where(''$lead->prospect_id));
//        };
        $lead->update($request->all());

        return redirect('/leads');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lead $lead)
    {
        $lead->status = 1;
        $lead->save();
        return redirect('/leads');
    }

    public function searchLeads(Request $request)
    {
        $search_result = CustomersRepo::customerInit()->searchCustomers($request->search_item, 'leads');

        $output = "";
        foreach ($search_result as $item){

            $output .= '<tr>'.
                '<td>'. ucwords($item->name).'</td>'.
                '<td>'.ucfirst($item->contact_person).'</td>'.
                '<td>'.$item->phone.'</td>'.
                '<td>'.$item->email.'</td>'.
//                '<td>'.$item->address.'</td>'.
                '<td>'.$item->telephone.'</td>'.
//                '<td>'.$item->location.'</td>'.
                '<td>'.Carbon::parse($item->created_at)->format('d-M-y').'</td>'.
                '<td>'.
'<form action="'.route('leads.destroy', $item->id).'" method="post">'.
                '<a href="'.route('leads.show', $item->id).'" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>'.
                                                '<a href="'.route('leads.edit', $item->id).'" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>'.
                                                csrf_field().'<br>'.
                                                method_field('DELETE').
                                                '<button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>'.
                                            '</form></td>'.
                '</tr>';
        }

        return Response(['output' => $output]);
    }
}
