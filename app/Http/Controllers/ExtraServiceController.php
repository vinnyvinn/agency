<?php

namespace App\Http\Controllers;

use App\ExtraService;
use App\ExtraServiceType;
use Esl\Repository\StkItemRepo;
use Illuminate\Http\Request;

class ExtraServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('extra-services.index')
            ->withServices(ExtraService::with(['type'])->simplePaginate(25));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('extra-services.create')
            ->withTypes(ExtraServiceType::all()->sortBy('name'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $desc = ExtraServiceType::findOrFail($request->extra_service_type_id);
        $data = $request->all();
        $data['type'] = $desc->name;
        $data['stk_id'] = StkItemRepo::init()->insertService($data);
//        dd($data);
        ExtraService::create($data);



        return redirect('/other-services');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ExtraService  $extraService
     * @return \Illuminate\Http\Response
     */
    public function show(ExtraService $extraService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExtraService  $extraService
     * @return \Illuminate\Http\Response
     */
    public function edit($extraService)
    {
        return view('extra-services.edit')
            ->withService(ExtraService::findOrFail($extraService))
            ->withTypes(ExtraServiceType::all()->sortBy('name'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExtraService  $extraService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $extraService)
    {
        ExtraService::findOrFail($extraService)->update($request->all());
        return redirect('/other-services');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExtraService  $extraService
     * @return \Illuminate\Http\Response
     */
    public function destroy($extraService)
    {

ExtraService::findOrFail($extraService)->delete();
        return redirect('/other-services');
    }
}
