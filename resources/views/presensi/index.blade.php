@extends('layouts/master')
{{-- @section('title', 'Data Karyawan') --}}
@section('container')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data Absensi</h3>
              </div>
              @if (session('status'))
                  <div class="alert alert-default-success">
                    {{session('status')}}
                  </div>
              @endif
              <div class="card-body">
                <form action="{{url('/presensi/search')}}" method="GET">
                  <div class="row mb-2">
                    <div class="col">
                        {{-- <a href="{{url('/register/add')}}" class="btn btn-primary btn-responsive mt-1 mb-2">Tambah data</a> --}}
                    </div>
                    
                    <div class="col-md-6">
                      <div class="input-group mt-1">
                          <input type="text" class="form-control mr-1" id="inlineFormInputGroup" name="search"
                          placeholder="Search..." value="{{\Request::get('search')}}">
                          <button type="submit" class="btn btn-primary mb-2 px-4">Search</button>
    
                          {{-- @if (Auth::user()->role == '2')
                            <button type="submit" name="download" target="_blank" class="btn btn-primary btn-responsive ml-2 mb-2 btn-download"
                          value="1"><i class="fas fa-download"></i></i> Download</button>
                          @endif --}}
                      </div>
                    </div>
                  </div>
                </form>
                <div style="overflow-x:auto;">
                  <table id="alltables" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Divisi</th>
                        <th scope="col">Tipe Absensi</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Verifikasi</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Catatan</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($data as $list)
                      <tr>
                        <td>{{ $list->created_at }}</td>
                        <td>{{ $list->name }}</td>
                        <td>{{ $list->division }}</td>

                        @if ($list->type_absensi == '1')
                        <td>Kantor</td>
                        @else
                        <td>Luar Kantor</td>
                        @endif

                        <td>{{ $list->image }}</td>
                        
                        @if ($list->verification == '0')
                        <td><span class="badge badge-warning">Proses</span></td>
                        @elseif ($list->verification == '1')
                        <td><span class="badge badge-success">Accept</span></td>
                        @else
                        <td><span class="badge badge-danger">Reject</span></td>
                        @endif

                        <td>{{ $list->address }}</td>

                        <td>{{ $list->noted }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="row mt-3">
                  <div class="col-lg-12">
                    <ul class="pagination justify-content-end">
                      <li class="page-item">{{ $data->appends(\Request::except('_token'))->render() }}</li>
                    </ul>
                  </div>
                </div>
              </div>
              {{-- body --}}
            </div>
          </div>
      </div>
    </div>
  </div>
@endsection

