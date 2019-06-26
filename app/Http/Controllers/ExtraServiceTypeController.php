<?php

namespace App\Http\Controllers;

use App\ExtraServiceType;
use Illuminate\Http\Request;

class ExtraServiceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('extra-service-type.index')
            ->withServices(ExtraServiceType::get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('extra-service-type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ExtraServiceType::create($request->all());

        return redirect('/other-services-type');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ExtraServiceType  $extraServiceType
     * @return \Illuminate\Http\Response
     */
    public function show(ExtraServiceType $extraServiceType)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExtraServiceType  $extraServiceType
     * @return \Illuminate\Http\Response
     */
    public function edit($extraServiceType)
    {
        return view('extra-service-type.edit')
            ->withService(ExtraServiceType::findOrFail($extraServiceType));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExtraServiceType  $extraServiceType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $extraServiceType)
    {
        ExtraServiceType::findOrFail($extraServiceType)->update($request->all());
        return redirect('/other-services-type');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExtraServiceType  $extraServiceType
     * @return \Illuminate\Http\Response
     */
    public function destroy($extraServiceType)
    {
        ExtraServiceType::findOrFail($extraServiceType)->delete();
        return redirect('/other-services-type');
    }
}
