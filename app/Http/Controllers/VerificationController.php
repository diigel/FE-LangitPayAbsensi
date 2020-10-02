<?php

namespace App\Http\Controllers;

use App\Models\lp_absensi;
use Illuminate\Http\Request;

class VerificationController extends Controller
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
            $data = lp_absensi::where('verification', '0')->latest()->paginate(10);
        } else {
            $data = lp_absensi::where(function ($query) use ($request) {
                $query->where('name', 'LIKE', "%$request->search%")
                    ->orWhere('noted', 'LIKE', "%$request->search%")
                    ->orWhere('division', 'LIKE', "%$request->search%")
                    ->orWhere('address', 'LIKE', "%$request->search%");
            })
                ->where('verification', '0')
                ->latest()->paginate(10);
        }
        return view('verifikasi.index', ['data' => $data]);
    }

    public function accept($id)
    {
        $data = lp_absensi::find($id);
        $data->verification = '1';
        $data->save();
        return redirect('verification/index')->with('status', 'Berhasil diaccept');
    }

    public function reject($id)
    {
        $data = lp_absensi::find($id);
        $data->verification = '2';
        $data->save();

        return redirect('verification/index')->with('status', 'Berhasil direject');
    }
}
