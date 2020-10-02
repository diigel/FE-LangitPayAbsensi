<?php

namespace App\Http\Controllers;

use App\Models\lp_user;
use Illuminate\Http\Request;

class EmployeController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search == null) {
            $data = lp_user::latest()->paginate(10);
        } else {
            $data = lp_user::where('nik', 'LIKE', "%$request->search%")
                ->orWhere('name', 'LIKE', "%$request->search%")
                ->orWhere('email', 'LIKE', "%$request->search%")
                ->latest()->paginate(10);
        }
        return view('employe.index', ['data' => $data]);
    }
}
