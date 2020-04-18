<?php

namespace App\Http\Controllers;

use App\NotifyingParty;
use Illuminate\Http\Request;

class NotifyingPartyController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NotifyingParty  $notifyingParty
     * @return \Illuminate\Http\Response
     */
    public function show(NotifyingParty $notifyingParty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NotifyingParty  $notifyingParty
     * @return \Illuminate\Http\Response
     */
    public function edit(NotifyingParty $notifyingParty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NotifyingParty  $notifyingParty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NotifyingParty $notifyingParty)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NotifyingParty  $notifyingParty
     * @return \Illuminate\Http\Response
     */
    public function destroy(NotifyingParty $notifyingParty)
    {
        //
    }

    public function notifying(Request $request)
    {
        $data = $request->all();
        $data['emails'] = json_encode(explode(',',$request->notifying));
        NotifyingParty::create($data);

        return Response(['success' => ['redirect' => url('/quotation/'.$request->quotation_id)]]);

    }
}
