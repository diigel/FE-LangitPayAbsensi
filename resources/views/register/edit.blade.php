@extends('layouts.master')

@section('container')
<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            {{-- Form --}}
            <div class="col-md-6">
                <!-- general form elements disabled -->
                <div class="card card-primary mt-1">
                  <div class="card-header">
                    <h3 class="card-title">Register Form</h3>
                  </div>
                  @if (session('status'))
                      <div class="alert alert-default-success">
                        {{session('status')}}
                      </div>
                  @endif
                  <!-- /.card-header -->
                  <div class="card-body">
                    <form role="form" action="{{url('employe/update')}}/{{$data->id}}" method="POST">
                      @csrf
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>NIK</label>
                            <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" placeholder="NIK" value="{{$data->NIK}}">
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama" value="{{$data->name}}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Emal</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" autocomplete="email" value="{{$data->email}}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                              <option value="null" disabled>Pilih Jenis Kelamin</option>
                              <option value="1" {{$data->gender == '1' ? 'selected' : ''}}>Laki - Laki</option>
                              <option value="2" {{$data->gender == '2' ? 'selected' : ''}}>Perempuan</option>
                              <option value="3" {{$data->gender == '3' ? 'selected' : ''}}>Tidak Diketahui</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Divisi</label>
                            <select name="division" class="form-control @error('division') is-invalid @enderror">
                              <option value="null" disabled>Pilih Divisi</option>
                              <option value="IT" {{$data->division == 'IT' ? 'selected' : ''}}>IT</option>
                              <option value="Customer Service" {{$data->gender == 'Customer Service' ? 'selected' : ''}}>Customer Service</option>
                              <option value="Marketing" {{$data->gender == 'Marketing' ? 'selected' : ''}}>Marketing</option>
                            </select>
                            @error('division')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" autocomplete="new-password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <input type="submit" value="Simpan" class="btn btn-primary">
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <!-- /.card -->
              </div>
            {{-- /Form --}}
        </div>
    </div>
</div>
@endsection
