<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (\Auth::guest()) {
            return view('auth.login');
        }

        if (\Gate::allows('manager', \Auth::user())) {
            return redirect()->route('admin.home');
        }

        return view('home');
    }
}
