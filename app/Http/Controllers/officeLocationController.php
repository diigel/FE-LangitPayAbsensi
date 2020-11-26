<?php

namespace App\Http\Controllers;

use App\Models\officeLocation;
use Illuminate\Http\Request;

class officeLocationController extends Controller
{
    public function index()
    {
        $data = officeLocation::latest()->paginate(10);
        return view('officeLocation.index', ['data' => $data]);
    }

    public function add()
    {
        return view('officeLocation.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required',
            'address'      => 'required',
            'lat'     => 'required',
            'long'    => 'required'
        ], [
            'name.required'        => 'Nama kantor harus di isi',
            'address.required'       => 'Alamat harus di isi',
            'address.unique'      => 'Alamat sudah ada',
            'lat.required'      => 'Latitude harus di isi',
            'lat.unique'        => 'Latitude sudah ada',
            'long.required'      => 'Longtitude harus di isi',
            'long.unique'        => 'Longtitude sudah ada',
        ]);

        $data = new officeLocation();
        $data->office_name = $request->name;
        $data->address     = $request->address;
        $data->lat         = $request->lat;
        $data->long        = $request->long;
        $data->save();

        return redirect('office-location/index')->with('status', 'Lokasi kantor berhasil ditambah');
    }

    public function show($id)
    {
        $data = officeLocation::find($id);
        return view('officeLocation.edit', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'       => 'required',
            'address'      => 'required',
            'lat'     => 'required',
            'long'    => 'required'
        ], [
            'name.required'        => 'Nama kantor harus di isi',
            'address.required'       => 'Alamat harus di isi',
            'address.unique'      => 'Alamat sudah ada',
            'lat.required'      => 'Latitude harus di isi',
            'lat.unique'        => 'Latitude sudah ada',
            'long.required'      => 'Longtitude harus di isi',
            'long.unique'        => 'Longtitude sudah ada',
        ]);

        $data = officeLocation::find($id);
        $data->office_name = $request->name;
        $data->address     = $request->address;
        $data->lat         = $request->lat;
        $data->long        = $request->long;
        $data->save();

        return redirect('office-location/index')->with('status', 'Lokasi kantor berhasil diubah');
    }

    public function destroy($id)
    {
        $data = officeLocation::find($id);
        $data->delete();
        return redirect('office-location/index')->with('status', 'Lokasi kantor berhasil dihapus');
    }
}
