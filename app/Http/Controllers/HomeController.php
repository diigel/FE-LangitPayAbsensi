<?php

namespace App\Http\Controllers;

use App\Models\lp_absensi;
use App\Models\lp_user;
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
        $employe = lp_user::get();
        $absensi = lp_absensi::where("created_at", ">=", date("Y-m-d") . " 00:00:00")->where("created_at", "<=", date("Y-m-d") . " 23:59:59")->get();
        return view('home', ['employe' => count($employe), 'absensi' => count($absensi)]);
    }
}
