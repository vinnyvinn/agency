<?php

namespace App\Http\Controllers;

use App\Mail\NewItem;
use App\Tariff;
use Esl\Repository\StkItemRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TariffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tariffs.index')
            ->withTariffs(Tariff::get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tariffs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $data['stk_id']= StkItemRepo::init()->insertService($data);

        Mail::to(['accounts@esl-eastafrica.com'])
            ->cc(['evans@esl-eastafrica.com'])
            ->send(new NewItem(['name'=>$data['name'],
                'company'=>'ESL_LTD'],$data['name'].' Added into Sage'));

        Tariff::create($data);

        return redirect('/tariffs');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tariff  $tariff
     * @return \Illuminate\Http\Response
     */
    public function show(Tariff $tariff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tariff  $tariff
     * @return \Illuminate\Http\Response
     */
    public function edit(Tariff $tariff)
    {
        return view('tariffs.edit')
            ->withTariff($tariff);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tariff  $tariff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tariff $tariff)
    {
        $tariff->update($request->all());

        return redirect('/tariffs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tariff  $tariff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tariff $tariff)
    {
        $tariff->delete();
        return redirect('/tariffs');
    }
}
