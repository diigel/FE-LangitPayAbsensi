<?php

namespace App\Http\Controllers;

use App\Exports\PresensiExport;
use App\Models\lp_absensi;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PresensiController extends Controller
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
            $data = lp_absensi::where('verification', '!=', '0')->latest();
        } else {
            $data = lp_absensi::where(function ($query) use ($request) {
                $query->where('name', 'LIKE', "%$request->search%")
                    ->orWhere('noted', 'LIKE', "%$request->search%")
                    ->orWhere('division', 'LIKE', "%$request->search%")
                    ->orWhere('address', 'LIKE', "%$request->search%");
            })->where('verification', '!=', '0')->latest();
        }

        if ($request->input('download') == '1') return $this->export($data->get());

        return view('presensi.index', ['data' => $data->paginate(10)]);
    }

    private function export($data)
    {
        return Excel::download(new PresensiExport($data), 'absensi_data_' . date('Y-m-d H:i:s') . '.xlsx');
    }

    public function exportPeriode(Request $request)
    {
        $data = lp_absensi::where('verification', '!=', '0')
            ->where("created_at", ">=", $request->startDate . " 00:00:00")
            ->where("created_at", "<=", $request->endDate . " 23:59:59")->get();

        if (count($data) < 1) {
            return redirect('presensi/index')->with('status-error', 'Data absensi tidak ditemukan');
        }
        return Excel::download(new PresensiExport($data), 'absensi_data_' . $request->startDate . "-" . $request->endDate . '.xlsx');
    }
}
