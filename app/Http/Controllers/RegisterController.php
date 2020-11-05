<?php

namespace App\Http\Controllers;

use App\Models\lp_user;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class RegisterController extends Controller
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
    public function index()
    {
        return view('register.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik'       => 'required',
            'name'      => 'required|string|min:4',
            'email'     => 'required|email|max:50|unique:lp_user',
            'gender'    => 'required',
            'division'  => 'required',
            'password'  => 'required|string|min:6',
        ]);

        $data = new lp_user();
        $data->nik      = $request->nik;
        $data->name     = $request->name;
        $data->password = $request->password;
        $data->email    = $request->email;
        $data->division = $request->division;
        $data->gender   = $request->gender;
        $data->save();

        return redirect('register/add')->with('status', 'Karyawan berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
