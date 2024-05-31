@extends('layouts.app-back-end')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">{{$jenis}} Data Kota</h1>
<br>

<!-- DataTales Example -->
<div class="card shadow mb-4" style="width: 60%;">
    <div class="card-header py-3">
        @if($url == null)
          <a href="{{route('data-kota.edit', base64_encode($id))}}"  title="Edit" class="btn btn-info btn-icon-split"  style="float: left; margin-right: 5px;">
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
        
          <form id="form-hapus-{{base64_encode($id)}}" class="d-inline" action="{{route('data-kota.destroy', base64_encode($id))}}" method="POST">
              {{ csrf_field() }}
              <input type="hidden" name="_method" value="DELETE">
          </form>
        @endif
        <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> -->
        <a href="{{route('data-kota.index')}}" class="btn btn-warning btn-icon-split"  style="float: right;">
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
              <label class="col-sm-3 col-form-label" for="nama_kota">Nama Kota</label>
              <div class="col-sm-6">
              <input value="@isset($data){{$data->nama_kota}}@endisset" class="form-control disabledShow {{$errors->first('nama_kota') ? "is-invalid": ""}}" placeholder="Nama Kota" type="text" name="nama_kota" id="nama_kota" required/></div>
              <div class="invalid-feedback">
                {{$errors->first('nama_kota')}}
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label" for="koory">Latitude</label>
              <div class="col-sm-6">
              <input value="@isset($data){{$data->koory}}@endisset" class="form-control disabledShow {{$errors->first('koory') ? "is-invalid": ""}}" placeholder="Latitude" type="text" name="koory" id="koory"/></div>
              <div class="invalid-feedback">
                {{$errors->first('koory')}}
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label" for="koorx">Longitude</label>
              <div class="col-sm-6">
              <input value="@isset($data){{$data->koorx}}@endisset" class="form-control disabledShow {{$errors->first('koorx') ? "is-invalid": ""}}" placeholder="Longitude" type="text" name="koorx" id="koorx"/></div>
              <div class="invalid-feedback">
                {{$errors->first('koorx')}}
              </div>
            </div>

            @if($url != '')
                <hr class="my-4">
                <div class="row">
                <div class="col-md-3"></div> 
                <div class="col-md-9 text-right">  
                    <button type="reset" class="btn btn-danger editHide" onclick="$('#select2-jenis-container').attr('title', '');$('#select2-jenis-container').html('Pilih Jenis');" href="{{route('data-kota.index')}}"><i class="fas fa-eraser" aria-hidden="true"></i> &nbsp; Reset</a>
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
          text: "apakah anda yakin untuk menghapus data kota ini?",
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