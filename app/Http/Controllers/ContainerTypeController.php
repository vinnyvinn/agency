<?php

namespace App\Http\Controllers;

use App\ContainerType;
use Illuminate\Http\Request;

class ContainerTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('container-type.index')
            ->withTypes(ContainerType::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('container-type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ContainerType::create($request->all());

        return redirect('/container-types');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ContainerType  $containerType
     * @return \Illuminate\Http\Response
     */
    public function show(ContainerType $containerType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContainerType  $containerType
     * @return \Illuminate\Http\Response
     */
    public function edit(ContainerType $containerType)
    {
        return view('container-type.edit')
            ->withType($containerType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContainerType  $containerType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContainerType $containerType)
    {
        $containerType->update($request->all());

        return redirect('/container-types');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContainerType  $containerType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContainerType $containerType)
    {
        $containerType->delete();

        return redirect('/container-types');
    }
}
