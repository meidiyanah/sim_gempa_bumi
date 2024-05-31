@extends('layouts.app-back-end')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Ganti Password</h1>
<br>

<!-- DataTales Example -->
<div class="card shadow mb-4" style="width: 60%;">
    <div class="card-header py-3">
        <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> -->
        <a href="{{route('home')}}" class="btn btn-warning btn-icon-split"  style="float: right;">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-left"></i>
            </span>
            <span class="text">Kembali</span>
        </a>
    </div>
    <div class="card-body">
        <form enctype="multipart/form-data" action="{{route('password.update')}}" method="POST">
            {{ csrf_field() }}
            @if(session('status'))
              <div class="alert alert-success">
                <button style="float: right;" type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{session('status')}}
              </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <button style="float: right;" type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <ul style="margin: 0 0 0 0 !important;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group row">
              <label class="col-sm-3 col-form-label" for="password">Password</label>
              <div class="col-sm-6">
                <input value="" class="form-control disabledShow {{$errors->first('password') ? "is-invalid": ""}}" placeholder="Password" type="password" name="password" id="password" required/>
              </div>
              <div class="invalid-feedback">
                {{$errors->first('password')}}
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label" for="confirm_password">Confirm Password</label>
              <div class="col-sm-6">
                <input value="" class="form-control disabledShow {{$errors->first('confirm_password') ? "is-invalid": ""}}" placeholder="Confirm Password" type="password" name="confirm_password" id="confirm_password" required />
              </div>
              <div class="invalid-feedback">
                {{$errors->first('confirm_password')}}
              </div>
            </div>

            <hr class="my-4">
            <div class="row">
                <div class="col-md-3"></div> 
                <div class="col-md-9 text-right">  
                    <button type="submit" class="btn btn-primary" style="margin-left: 5px;"><i class="fas fa-save"></i> &nbsp; Simpan</button>
                </div>
            </div>  
        </form>
    </div>
</div>
@endsection