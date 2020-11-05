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
                    <form role="form" action="{{url('register/store')}}" method="POST">
                      @csrf
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>NIK</label>
                            <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" placeholder="NIK">
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Emal</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" autocomplete="email">
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
                              <option value="null" disabled selected>Pilih Jenis Kelamin</option>
                              <option value="1">Laki - Laki</option>
                              <option value="2">Perempuan</option>
                              <option value="3">Tidak Diketahui</option>
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
                              <option value="null" disabled selected>Pilih Divisi</option>
                              <option value="IT">IT</option>
                              <option value="Customer Service">Customer Service</option>
                              <option value="Marketing">Marketing</option>
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
