<?php

namespace App\Http\Controllers;

use App\Tariff;
use Illuminate\Http\Request;

class AgencyServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Tariff::all());

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tariff = Tariff::where('name', 'like', '%' . $request->name . '%')->first();
        return response()->json($tariff);
    }
}
