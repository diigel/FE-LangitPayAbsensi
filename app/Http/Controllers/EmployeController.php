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

    public function view($id)
    {
        $data = lp_user::find($id);
        return view('register/edit', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nik'       => 'required',
            'name'      => 'required|string|min:4',
            'email'     => 'required|max:255|email|unique:lp_user,email,' . $id . ',id',
            'gender'    => 'required',
            'division'  => 'required',
            'password'  => 'nullable|string|min:6',
        ]);

        $data = lp_user::find($id);
        $data->nik      = $request->nik;
        $data->name     = $request->name;
        if ($request->password != null) {
            $data->password = $request->password;
        }
        $data->email    = $request->email;
        $data->division = $request->division;
        $data->gender   = $request->gender;
        $data->save();

        return redirect('employe/index')->with('status', 'Karyawan berhasil diubah');
    }
}
