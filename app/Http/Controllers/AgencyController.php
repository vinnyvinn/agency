<?php

namespace App\Http\Controllers;

use App\Quotation;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    public function index()
    {
        $quotation = Quotation::with(['lead','vessel','user'])->get();

        return view('agency.index')
            ->withQuotations($quotation);
    }


}
