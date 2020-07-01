<?php

namespace App\Http\Controllers;

use App\Lead;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
       $user = User::first();
       Auth::login($user);
      // dd(Auth::check());
        return view('dashboard.dashboard')
            ->withLeads(Lead::simplePaginate(25));
    }
}
