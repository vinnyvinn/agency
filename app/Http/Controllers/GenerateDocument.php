<?php

namespace App\Http\Controllers;

use App\BillOfLanding;
use App\Cargo;
use App\Consignee;
use App\SavedInWard;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class GenerateDocument extends Controller
{
    public function cfsDoc(Request $request)
    {
        $dos = $request->all();

        $data = [];
        foreach ($request->weight as $key => $value){
            array_push($data,[
                'weight' => $value,
                'bl_no' => $dos['bl_no'][$key],
                'marks' => $dos['marks'][$key],
                'description' => $dos['description'][$key]
            ]);
        }

        return view('documents.cfs-ro')
            ->withData($data)
            ->withClient($dos);
    }

    public function inmanifestDoc(Request $request)
    {
        $dos = $request->all();

        $data = [];

        $checkSavedInward = SavedInWard::where('bill_of_landing_id',$request->bl_id)->get();

        if (count($checkSavedInward) > 0){
            foreach ($checkSavedInward as $item){
                if ($item->toggle_type == 1 && $request->has('outward')){
                    $this->update($item, $dos);
                }
                else{
                    $this->update($item, $dos);
                }
            }

        }
        else{
            $this->save($dos, ($request->has('outward') ? 1 : 0));
        }

        if ($request->has('weight')){
            foreach ($request->weight as $key => $value){
                array_push($data,[
                    'weight' => $value,
                    'consignee' => $dos['consignee'][$key],
                    'shipper' => $dos['shipper'][$key],
                    'party' => $dos['party'][$key],
                    'bl_no' => $dos['bl_no'][$key],
                    'marks' => $dos['marks'][$key],
                    'description' => $dos['description'][$key]
                ]);
            }
        }

        if ($request->has('incargoid')){
            foreach ($request->inweight as $key => $value){
                array_push($data,[
                    'weight' => $value,
                    'consignee' => $dos['inconsignee'][$key],
                    'shipper' => $dos['inshipper'][$key],
                    'party' => $dos['inparty'][$key],
                    'bl_no' => $dos['inbl_no'][$key],
                    'marks' => $dos['inmarks'][$key],
                    'description' => $dos['indescription'][$key]
                ]);
            }
        }

        return view('documents.manifest-in')
            ->withData($data)
            ->withTitle($request->has('outward') ? 'OUTWARD' : 'INWARD')
            ->withClient($dos);

    }


    public function save(array $data, $type)
    {
        SavedInWard::create([
            'bill_of_landing_id' => $data['bl_id'],
            'toggle_type' => $type,
            'data' => json_encode($data)
        ]);

        return true;
    }

    public function update(SavedInWard $inWard, array $data)
    {
        $inWard->update([
            'bill_of_landing_id' => $data['bl_id'],
            'data' => json_encode($data)
        ]);

        return true;
    }

    public function doDoc(Request $request)
    {
        $dos = $request->all();
//        dd($request->all());
        $dms = BillOfLanding::with(['vessel','quote.services',
            'quote.voyage','customer','quote.cargos.consignee'])->findOrFail($request->bl_id);
        $client = Consignee::with(['cargo'])->findOrFail($request->consignee_id);

        return view('documents.do1')
            ->withDms($dms)
            ->withDos($dos)
            ->withClient($client);
    }

    public function edoDoc(Request $request)
    {
        $cargo = Cargo::with(['quotation'])->findOrFail($request->cargo_id);

        $dms = BillOfLanding::with(['vessel.vDocs','sof','quote.services',
            'quote.voyage','customer','quote.cargos.consignee','quote.logs'])->where('quote_id',$cargo->quotation_id)->first();

        $cargo->edo == 0 ? 9 : ($cargo->edo == 9 ? 5 : 1 );

        $cargo->save();

        $data = "HDR01DO".str_repeat(" ", 4)."461".str_repeat(" ", 11)."EXP".
            str_repeat(" ", 11).strtoupper($dms->vessel->port_of_discharge_code)."CONV\n";
        $data = $data . "REC01".strtoupper($dms->vessel->call_sign).str_repeat(" ", (20 - (strlen("REC01".strtoupper($dms->vessel->call_sign))))).
            strtoupper($dms->quote->voyage->voyage_no).str_repeat(" ", (35 - (20 + (strlen($dms->quote->voyage->voyage_no)))) ).strtoupper($cargo->bl_no).
            str_repeat(" ", (65 -(35 + strlen($cargo->bl_no))) ).($request->edo).(strtoupper($dms->id)).
            str_repeat(" ", (96 - (65 + strlen($request->edo.$dms->id))) ).(strtoupper($request->pin));
        $fileName = time() . '_EDO.txt';
        File::put(public_path('/documents/'.$fileName),$data);
        return Response::download(public_path('/documents/'.$fileName));
    }
    public function generateDocument($type, $id)
    {
        if ($type == 'cargo-manifest'){

//            return view('documents.cargo-manifest',compact('dms'));

            $pdf = PDF::loadView('documents.cargo-manifest',compact('dms'));
            $pdf->setPaper('A4', 'portrait');
            return $pdf->download('cargo-manifest.pdf');
        }

        elseif ($type == 'cfs-ro'){
            //            return view('documents.cargo-manifest',compact('dms'));

            $pdf = PDF::loadView('documents.cfs-ro',compact('dms'));
            $pdf->setPaper('A4', 'portrait');
            return $pdf->download('cfs-release-order.pdf');
        }

        elseif ($type == 'zila'){
            $cargo = Cargo::with(['quotation'])->findOrFail($id);

            $dms = BillOfLanding::with(['vessel.vDocs','sof','quote.services',
                'quote.voyage','customer','quote.cargos.consignee','quote.logs'])->where('quote_id',$cargo->quotation_id)->first();

            $cargo->edo == 0 ? 9 : ($cargo->edo == 9 ? 5 : 1 );

            $cargo->save();

            $data = "HDR01DO".str_repeat(" ", 4)."461".str_repeat(" ", 11)."EXP".
                str_repeat(" ", 11).strtoupper($dms->vessel->port_of_discharge_code)."CONV\n";
            $data = $data . "REC01".strtoupper($dms->vessel->call_sign).str_repeat(" ", (20 - (strlen("REC01".strtoupper($dms->vessel->call_sign))))).
            strtoupper($dms->quote->voyage->voyage_no).str_repeat(" ", (35 - (20 + (strlen($dms->quote->voyage->voyage_no)))) ).strtoupper($cargo->bl_no).
                str_repeat(" ", (65 -(35 + strlen($cargo->bl_no))) ).($cargo->edo).(strtoupper($dms->id)).
                str_repeat(" ", 96 )."P0511534053";
            $fileName = time() . '_EDO.txt';
            File::put(public_path('/documents/'.$fileName),$data);
            return Response::download(public_path('/documents/'.$fileName));

        }
        elseif ($type == 'inward-manifest'){
//                        return view('documents.inward-manifest',compact('dms'));

            $pdf = PDF::loadView('documents.inward-manifest',compact('dms'));
            $pdf->setPaper('A4', 'portrait');
            return $pdf->download('inward-manifest.pdf');
        }
        elseif ($type == 'outward-manifest'){
//                        return view('documents.inward-manifest',compact('dms'));

            $pdf = PDF::loadView('documents.outward-manifest',compact('dms'));
            $pdf->setPaper('A4', 'portrait');
            return $pdf->download('outward-manifest.pdf');
        }

        elseif ($type == 'bl'){
//                        return view('documents.bl',compact('dms'));

            $pdf = PDF::loadView('documents.bl',compact('dms'));
            $pdf->setPaper('A4', 'portrait');
            return $pdf->download('bl.pdf');
        }
        elseif ($type == 'do'){
//                        return view('documents.bl',compact('dms'));

            $pdf = PDF::loadView('documents.bl',compact('dms'));
            $pdf->setPaper('A4', 'portrait');
            return $pdf->download('bl.pdf');
        }

        else{
            return redirect()->back();
        }

    }
}
