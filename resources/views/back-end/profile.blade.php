@extends('layouts.app-back-end')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Profil Pribadi</h1>
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
        <form enctype="multipart/form-data" action="{{route('profile.update')}}" method="POST">
            {{ csrf_field() }}
            @if(session('status'))
              <div class="alert alert-success">
                <button style="float: right;" type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{session('status')}}
              </div>
            @endif

            <div class="form-group row">
              <label class="col-sm-3 col-form-label" for="name">Nama</label>
              <div class="col-sm-6">
                <input value="@isset($data){{$data->name}}@endisset" class="form-control disabledShow {{$errors->first('name') ? "is-invalid": ""}}" placeholder="Nama" type="text" name="name" id="name" required/>
              </div>
              <div class="invalid-feedback">
                {{$errors->first('name')}}
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label" for="jenis_user">Jenis Pengguna</label>
              <div class="col-sm-6">
                <select name="jenis_user" id="jenis_user" style="width: 100%;" class="form-control select2 {{$errors->first('jenis_user') ? "is-invalid" : ""}}" data-placeholder="Pilih Jenis Pengguna" required>
                    <option></option>
                    @foreach($jenis as $key => $jen)
                        <option value="{{$jen->id}}" @isset($data) @if($data->jenis_user == $jen->id) selected @endif @endisset>{{$jen->jenis_user}}</option>
                    @endforeach
                </select>
              </div>
              <div class="invalid-feedback">
                {{$errors->first('jenis_user')}}
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label" for="email">E-mail</label>
              <div class="col-sm-6">
                <input value="@isset($data){{$data->email}}@endisset" class="form-control disabledShow {{$errors->first('email') ? "is-invalid": ""}}" placeholder="E-mail" type="text" name="email" id="email"/>
              </div>
              <div class="invalid-feedback">
                {{$errors->first('email')}}
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label" for="password">Password</label>
              <div class="col-sm-6">
                <input value="" class="form-control disabledShow {{$errors->first('password') ? "is-invalid": ""}}" placeholder="Password" type="password" name="password" id="password"/>
                <span style="color: red;"><sup>**</sup> Silahkan isi password jika akan mengganti password</span>
              </div>
              <div class="invalid-feedback">
                {{$errors->first('password')}}
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label" for="confirm_password">Confirm Password</label>
              <div class="col-sm-6">
                <input value="" class="form-control disabledShow {{$errors->first('confirm_password') ? "is-invalid": ""}}" placeholder="Confirm Password" type="password" name="confirm_password" id="confirm_password"/>
              </div>
              <div class="invalid-feedback">
                {{$errors->first('confirm_password')}}
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label" for="avatar">Avatar</label>
              <div class="col-sm-6">
                <input class="form-control {{$errors->first('avatar') ? "is-invalid": ""}}" placeholder="Avatar" type="file" name="avatar" id="avatar" accept="image/png, image/gif, image/jpeg" />
                @isset($data)
                  @if(isset($data->avatar) && $data->avatar != null)
                    <div class="">
                      File Lama : <br>
                      <img src="{{asset('images/avatars/'.$data->id.'/'.$data->avatar)}}" width="100px">
                    </div>
                  @endif
                @endisset
              </div>
              <div class="invalid-feedback">
                {{$errors->first('avatar')}}
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label" for="status">Status</label>
              <div class="col-sm-6">
                <select name="status" id="status" style="width: 100%;" class="form-control {{$errors->first('status') ? "is-invalid" : ""}}" data-placeholder="Pilih Status" required>
                    <option value="" style="display: none;"></option>
                    <option value="ACTIVE" @isset($data) @if($data->status == 'ACTIVE') selected @endif @endisset>ACTIVE</option>
                    <option value="INACTIVE" @isset($data) @if($data->status == 'INACTIVE') selected @endif @endisset>INACTIVE</option>
                </select>
              </div>
              <div class="invalid-feedback">
                {{$errors->first('status')}}
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