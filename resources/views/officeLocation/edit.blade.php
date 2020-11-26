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
                    <h3 class="card-title">Ubah Lokasi</h3>
                  </div>
                  @if (session('status'))
                      <div class="alert alert-default-success">
                        {{session('status')}}
                      </div>
                  @endif
                  <!-- /.card-header -->
                  <div class="card-body">
                    <form role="form" action="{{url('office-location/update')}}/{{$data->id}}" method="POST">
                      @csrf
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Nama Kantor</label>
                            <input type="text" name="name" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama Kantor" value="{{$data->office_name}}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="address" cols="30" rows="10" class="form-control @error('address') is-invalid @enderror">{{$data->address}}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label>Latitude</label>
                          <input type="text" name="lat" class="form-control @error('lat') is-invalid @enderror" value="{{$data->lat}}">
                          @error('lat')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label>Longtitude</label>
                          <input type="text" name="long" class="form-control @error('long') is-invalid @enderror" value="{{ $data->long}}">
                          @error('long')
                              <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
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
