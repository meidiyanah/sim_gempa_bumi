@extends('layouts.app-back-end')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">{{$jenis}} Data Pengguna</h1>
<br>

<!-- DataTales Example -->
<div class="card shadow mb-4" style="width: 60%;">
    <div class="card-header py-3">
        @if($url == null)
          <a href="{{route('data-user.edit', base64_encode($id))}}"  title="Edit" class="btn btn-info btn-icon-split"  style="float: left; margin-right: 5px;">
              <span class="icon text-white-50">
                  <i class="fas fa-edit"></i>
              </span>
              <span class="text">Edit</span>
          </a>
          <button type="button" onclick="hapusData('{{base64_encode($id)}}')"  title="Hapus" class="btn btn-danger btn-icon-split" style="float: left;">
              <span class="icon text-white-50">
                  <i class="fas fa-trash"></i>
              </span>
              <span class="text">Hapus</span>
          </button>
        
          <form id="form-hapus-{{base64_encode($id)}}" class="d-inline" action="{{route('data-user.destroy', base64_encode($id))}}" method="POST">
              {{ csrf_field() }}
              <input type="hidden" name="_method" value="DELETE">
          </form>
        @endif
        <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> -->
        <a href="{{route('data-user.index')}}" class="btn btn-warning btn-icon-split"  style="float: right;">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-left"></i>
            </span>
            <span class="text">Kembali</span>
        </a>
    </div>
    <div class="card-body">
        <form enctype="multipart/form-data" @if($url != '') action="@if(isset($id)){{route($url, base64_encode($id))}}@else{{route($url)}}@endif" @endif method="POST">
            {{ csrf_field() }}

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
                <select name="jenis_user" id="jenis_user" style="width: 100%;" class="form-control disabledShow select2 {{$errors->first('jenis_user') ? "is-invalid" : ""}}" data-placeholder="Pilih Jenis Pengguna" required>
                    <option></option>
                    @foreach($jenis_user as $key => $jen)
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
                <input value="@isset($data){{$data->email}}@endisset" class="form-control disabledShow {{$errors->first('email') ? "is-invalid": ""}}" placeholder="E-mail" type="text" name="email" id="email" required/>
              </div>
              <div class="invalid-feedback">
                {{$errors->first('email')}}
              </div>
            </div>

            @if($url != "")
            <div class="form-group row">
              <label class="col-sm-3 col-form-label" for="password">Password</label>
              <div class="col-sm-6">
                <input value="" class="form-control disabledShow {{$errors->first('password') ? "is-invalid": ""}}" placeholder="Password" type="password" name="password" id="password" @if($jenis == 'Tambah') required @endif/>
                @if($jenis == 'Edit')<span style="color: red;"><sup>**</sup> Silahkan isi password jika akan mengganti password</span>@endif
              </div>
              <div class="invalid-feedback">
                {{$errors->first('password')}}
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label" for="confirm_password">Confirm Password</label>
              <div class="col-sm-6">
                <input value="" class="form-control disabledShow {{$errors->first('confirm_password') ? "is-invalid": ""}}" placeholder="Confirm Password" type="password" name="confirm_password" id="confirm_password" @if($jenis == 'Tambah') required @endif/>
              </div>
              <div class="invalid-feedback">
                {{$errors->first('confirm_password')}}
              </div>
            </div>
            @endif

            <div class="form-group row">
              <label class="col-sm-3 col-form-label" for="avatar">Avatar</label>
              <div class="col-sm-6">
                @if($url != "")
                    <input class="form-control {{$errors->first('avatar') ? "is-invalid": ""}}" placeholder="Avatar" type="file" name="avatar" id="avatar" accept="image/png, image/gif, image/jpeg" />
                @endif
                @isset($data)
                  @if(isset($data->avatar) && $data->avatar != null)
                    <div class="">
                      Avatar Lama : <br>
                      <img src="{{asset('images/avatars/'.$data->id.'/'.$data->avatar)}}" width="100px">
                    </div>
                  @else
                    <div class="">Tidak ada Avatar</div>
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
                <select name="status" id="status" style="width: 100%;" class="form-control disabledShow {{$errors->first('status') ? "is-invalid" : ""}}" data-placeholder="Pilih Status" required>
                    <option value="" style="display: none;"></option>
                    <option value="ACTIVE" @isset($data) @if($data->status == 'ACTIVE') selected @endif @endisset>ACTIVE</option>
                    <option value="INACTIVE" @isset($data) @if($data->status == 'INACTIVE') selected @endif @endisset>INACTIVE</option>
                </select>
              </div>
              <div class="invalid-feedback">
                {{$errors->first('status')}}
              </div>
            </div>

            @if($url != '')
                <hr class="my-4">
                <div class="row">
                <div class="col-md-3"></div> 
                <div class="col-md-9 text-right">  
                    <button type="reset" class="btn btn-danger editHide" onclick="$('#select2-jenis-container').attr('title', '');$('#select2-jenis-container').html('Pilih Jenis');" href="{{route('data-user.index')}}"><i class="fas fa-eraser" aria-hidden="true"></i> &nbsp; Reset</a>
                    <button type="submit" class="btn btn-primary" style="margin-left: 5px;"><i class="fas fa-save"></i> &nbsp; Simpan</button>
                </div>
                </div>  
            @endif
        </form>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
  @if($url == "")
      $('.disabledShow').attr('disabled', true);
  @else
      $('.editHide').hide();
  @endif
  
  function hapusData(id){
      Swal.fire({
          title: 'Hapus Data',
          text: "apakah anda yakin untuk menghapus data pengguna ini?",
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, Hapus!'
      }).then((result) => {
          if (result.isConfirmed) {
              $('#form-hapus-'+id).submit();
          }
      });
  }
</script>
@endsection