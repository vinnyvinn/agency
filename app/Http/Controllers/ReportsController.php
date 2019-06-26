<?php

namespace App\Http\Controllers;

use App\BillOfLanding;
use App\Lead;
use App\PurchaseOrder;
use App\Quotation;
use Esl\Repository\JobsReportsRepo;
use Illuminate\Http\Request;
use Excel;
use PDF;


class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reports.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $status = $request->get('status');
        $jobs = '';
        if ($status=='all') {
            $jobs = BillOfLanding::whereBetween('created_at', [$request->get('from'), $request->get('to')])->get();
        }
        if ($status=='active'){
            $jobs = BillOfLanding::where('status',0)->whereBetween('created_at', [$request->get('from'), $request->get('to')])->get();
        }
        if ($status=='completed'){
            $jobs = BillOfLanding::where('status',1)->whereBetween('created_at', [$request->get('from'), $request->get('to')])->get();
        }
        $from = date('d-m-Y',strtotime($request->get('from')));
        $to = date('d-m-Y',strtotime($request->get('to')));

        return view('reports.index')->with('jobs', $jobs)->with('from',$from)->with('to',$to)->with('status',$status);
    }


    public function exportPDF($from,$to,$status,$type)

    {
        $date_from = date('m/d/Y',strtotime($from));
        $date_to = date('m/d/Y',strtotime($to));
        $jobs = '';
        if ($status=='all') {
            $jobs = BillOfLanding::whereBetween('created_at', [$date_from, $date_to])->get();
        }
        elseif ($status=='active'){
            $jobs = BillOfLanding::where('status',0)->whereBetween('created_at', [$date_from, $date_to])->get();
        }
        elseif ($status=='completed'){
            $jobs = BillOfLanding::where('status',1)->whereBetween('created_at', [$date_from, $date_to])->get();
        }

        if ($type !='pdf') {
            return $this->downloadJob($date_from, $date_to, $status, $type);
        }

        $pdf = PDF::loadView('reports.generate-pdf',compact('jobs'));
        return $pdf->download('jobs.pdf');

    }
    private function downloadJob($date_from,$date_to,$status,$type){

        $data = JobsReportsRepo::init()->getJobs($date_from,$date_to,$status);
        return Excel::create('jobs', function ($excel) use ($data) {

            $excel->sheet('mySheet', function ($sheet) use ($data) {

                $sheet->fromArray($data);

            });

        })->download($type);
    }

    public function leadsReport()
    {
       return view('reports.leads.create');
}

    public function getLeads()
    {
        $leads = Lead::whereBetween('created_at', [request()->get('from'), request()->get('to')])->get();
        $from = date('d-m-Y',strtotime(request()->get('from')));
        $to = date('d-m-Y',strtotime(request()->get('to')));
        return view('reports.leads.index')->with('leads', $leads)->with('from',$from)->with('to',$to);
}

    public function exportLead($from,$to,$type)
    {
        $date_from = date('m/d/Y',strtotime($from));
        $date_to = date('m/d/Y',strtotime($to));

        if ($type !='pdf') {
            return $this->downloadLeads($date_from, $date_to,$type);
        }
        $leads = Lead::whereBetween('created_at', [$date_from, $date_to])->get();

        $pdf= PDF::loadView('reports.leads.generate-pdf', compact('leads'));
        return $pdf->download('leads.pdf');
    }

    private function downloadLeads($date_from,$date_to,$type)
    {
        $data = JobsReportsRepo::init()->getLeads($date_from,$date_to);
        return Excel::create('leads', function ($excel) use ($data) {

            $excel->sheet('mySheet', function ($sheet) use ($data) {

                $sheet->fromArray($data);

            });

        })->download($type);
    }

    public function pdasReport()
    {
        return view('reports.pdas.create');
    }

    public function getPdas()
    {
        $pdas = Quotation::where('status','!=','converted')->whereBetween('created_at', [request()->get('from'), request()->get('to')])->get();
        $from = date('d-m-Y',strtotime(request()->get('from')));
        $to = date('d-m-Y',strtotime(request()->get('to')));
        return view('reports.pdas.index')->with('pdas', $pdas)->with('from',$from)->with('to',$to);
    }

    public function exportPda($from,$to,$type)
    {
        $date_from = date('m/d/Y',strtotime($from));
        $date_to = date('m/d/Y',strtotime($to));
        $pdas = Quotation::where('status','!=','converted')->whereBetween('created_at', [$date_from, $date_to])->get();

        if ($type !='pdf') {
            return $this->downloadPdas($date_from, $date_to, $type);
        }

        $pdf = PDF::loadView('reports.pdas.generate-pdf',compact('pdas'));
        return $pdf->download('pdas.pdf');
    }
    private function downloadPdas($date_from,$date_to,$type)
    {

        $data = JobsReportsRepo::init()->getPdas($date_from,$date_to);
        return Excel::create('pdas', function ($excel) use ($data) {

            $excel->sheet('mySheet', function ($sheet) use ($data) {

                $sheet->fromArray($data);

            });

        })->download($type);
    }

    public function posReport()
    {
        return view('reports.po.create');
    }

    public function getPos()
    {
        $status = request()->get('status');
        $pos = '';
        if ($status=='requested'){
            $pos = PurchaseOrder::where('status','requested')->whereBetween('created_at', [request()->get('from'), request()->get('to')])->get();
        }
        elseif ($status=='approved'){
            $pos = PurchaseOrder::where('status','approved')->whereBetween('created_at', [request()->get('from'), request()->get('to')])->get();
        }

        $from = date('d-m-Y',strtotime(request()->get('from')));
        $to = date('d-m-Y',strtotime(request()->get('to')));
        return view('reports.po.index')->with('pos', $pos)->with('from',$from)->with('to',$to)->with('status',$status);
    }

    public function exportPo($from,$to,$status,$type)
    {
        $date_from = date('m/d/Y',strtotime($from));
        $date_to = date('m/d/Y',strtotime($to));
        $pos = '';
        if ($status=='requested'){
            $pos = PurchaseOrder::where('status','requested')->whereBetween('created_at', [$date_from, $date_to])->get();
        }
        elseif ($status=='approved'){
            $pos = PurchaseOrder::where('status','approved')->whereBetween('created_at', [$date_from, $date_to])->get();
        }

        if ($type !='pdf') {
            return $this->downloadPo($date_from, $date_to, $status, $type);
        }

        $pdf = PDF::loadView('reports.po.generate-pdf',compact('pos'));
        return $pdf->download('pos.pdf');
    }

    private function downloadPo($date_from,$date_to,$status,$type)
    {

        $data = JobsReportsRepo::init()->getPos($date_from,$date_to,$status);
        return Excel::create('pos', function ($excel) use ($data) {

            $excel->sheet('mySheet', function ($sheet) use ($data) {

                $sheet->fromArray($data);

            });

        })->download($type);
    }
}
