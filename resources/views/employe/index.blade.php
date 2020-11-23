@extends('layouts/master')
{{-- @section('title', 'Data Karyawan') --}}
@section('container')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data Karyawan</h3>
              </div>
              @if (session('status'))
                  <div class="alert alert-default-success">
                    {{session('status')}}
                  </div>
              @endif
              <div class="card-body">
                <form action="{{url('/employe/search')}}" method="GET">
                  <div class="row mb-2">
                    <div class="col">
                        <a href="{{url('/register/add')}}" class="btn btn-primary btn-responsive mt-1 mb-2">Tambah data</a>
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
                        <th scope="col">NIK</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Divisi</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($data as $list)
                      <tr>
                        <td>{{ $list->created_at }}</td>
                        <td>{{ $list->NIK }}</td>
                        <td>{{ $list->name }}</td>
                        <td>{{ $list->email }}</td>
                        <td>{{ $list->division }}</td>
                        @if ($list->gender == '1')
                        <td>Laki - Laki</td>
                        @elseif($list->gender == '2')
                        <td>Perempuan</td>
                        @else
                        <td>Tidak diketahui</td>
                        @endif
                        <td>
                            <a href="{{url('/employe/show')}}/{{$list->id}}" class="badge badge-warning"><i class="fas fa-edit"></i></a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="row mt-3">
                  <div class="col-lg-12">
                    <ul class="pagination justify-content-end">
                      {{ $data->appends(\Request::except('_token'))->render() }}
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

