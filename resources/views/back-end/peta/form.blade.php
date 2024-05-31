@extends('layouts.app-back-end')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">{{$jenis}} Data Peta</h1>
<br>

<!-- DataTales Example -->
<div class="card shadow mb-4" style="width: 60%;">
    <div class="card-header py-3">
        @if($url == null)
          <a href="{{route('data-peta.edit', base64_encode($id))}}"  title="Edit" class="btn btn-info btn-icon-split"  style="float: left; margin-right: 5px;">
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
        
          <form id="form-hapus-{{base64_encode($id)}}" class="d-inline" action="{{route('data-peta.destroy', base64_encode($id))}}" method="POST">
              {{ csrf_field() }}
              <input type="hidden" name="_method" value="DELETE">
          </form>
        @endif
        <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> -->
        <a href="{{route('data-peta.index')}}" class="btn btn-warning btn-icon-split"  style="float: right;">
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
              <label class="col-sm-3 col-form-label" for="nama">Nama</label>
              <div class="col-sm-6">
              <input value="@isset($data){{$data->nama}}@endisset" class="form-control disabledShow {{$errors->first('nama') ? "is-invalid": ""}}" placeholder="Nama" type="text" name="nama" id="nama" required/></div>
              <div class="invalid-feedback">
                {{$errors->first('nama')}}
              </div>
            </div>
            
            <div class="form-group row">
              <label class="col-sm-3 col-form-label" for="jenis">Jenis</label>
              <div class="col-sm-6">
                <select name="jenis" id="jenis" style="width: 100%;" class="form-control disabledShow select2 {{$errors->first('jenis') ? "is-invalid" : ""}}" data-placeholder="Pilih Jenis" onchange="toggleLayerName(this.value)" required>
                    <option></option>
                    <option value="Arcgis Online" @isset($data) @if($data->jenis == 'Arcgis Online') selected @endif @endisset>Arcgis Online</option>
                    <option value="Esri" @isset($data) @if($data->jenis == 'Esri') selected @endif @endisset>Esri</option>
                    <option value="Tile" @isset($data) @if($data->jenis == 'Tile') selected @endif @endisset>Tile</option>
                </select>
              </div>
              <div class="invalid-feedback">
                {{$errors->first('jenis')}}
              </div>
            </div>
            
            <div class="form-group row" id="url-field" style="display: none;">
              <label class="col-sm-3 col-form-label" for="url">URL</label>
              <div class="col-sm-6">
              <input value="@isset($data){{$data->url}}@endisset" class="form-control disabledShow {{$errors->first('url') ? "is-invalid": ""}}" placeholder="URL" type="text" name="url" id="url"/></div>
              <div class="invalid-feedback">
                {{$errors->first('url')}}
              </div>
            </div>

            <div class="form-group row" id="layername-field" style="display: none;">
              <label class="col-sm-3 col-form-label" for="layer_name">Nama Layer</label>
              <div class="col-sm-6">
              <input value="@isset($data){{$data->layer_name}}@endisset" class="form-control disabledShow {{$errors->first('layer_name') ? "is-invalid": ""}}" placeholder="Nama Layer" type="text" name="layer_name" id="layer_name"/></div>
              <div class="invalid-feedback">
                {{$errors->first('layer_name')}}
              </div>
            </div>

            <div class="form-group row" id="minzoom-field" style="display: none;">
              <label class="col-sm-3 col-form-label" for="min_zoom">Min. Zoom</label>
              <div class="col-sm-6">
              <input value="@isset($data){{$data->min_zoom}}@endisset" class="form-control disabledShow {{$errors->first('min_zoom') ? "is-invalid": ""}}" placeholder="Min. Zoom" type="number" min="0" name="min_zoom" id="min_zoom"/></div>
              <div class="invalid-feedback">
                {{$errors->first('min_zoom')}}
              </div>
            </div>

            <div class="form-group row" id="maxzoom-field" style="display: none;">
              <label class="col-sm-3 col-form-label" for="max_zoom">Max. Zoom</label>
              <div class="col-sm-6">
              <input value="@isset($data){{$data->max_zoom}}@endisset" class="form-control disabledShow {{$errors->first('max_zoom') ? "is-invalid": ""}}" placeholder="Max. Zoom" type="number" min="0" name="max_zoom" id="max_zoom"/></div>
              <div class="invalid-feedback">
                {{$errors->first('max_zoom')}}
              </div>
            </div>

            @if($url != '')
                <hr class="my-4">
                <div class="row">
                <div class="col-md-3"></div> 
                <div class="col-md-9 text-right">  
                    <button type="reset" class="btn btn-danger editHide" onclick="$('#select2-jenis-container').attr('title', '');$('#select2-jenis-container').html('Pilih Jenis');" href="{{route('data-peta.index')}}"><i class="fas fa-eraser" aria-hidden="true"></i> &nbsp; Reset</a>
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
    @if($url == 'data-peta.update' || $url == '')//KALAU EDIT DAN DETAIL
        toggleLayerName('{{$data->jenis}}');
        @if($url == "")
            $('.disabledShow').attr('disabled', true);
        @else
            $('.editHide').hide();
        @endif
    @endif

    function hapusData(id){
        Swal.fire({
            title: 'Hapus Data',
            text: "apakah anda yakin untuk menghapus data peta ini?",
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
    
    function toggleLayerName(val){
        if(val != null){
            document.getElementById('minzoom-field').style.display = 'none';
            document.getElementById('maxzoom-field').style.display = 'none';
            document.getElementById('layername-field').style.display = 'none';
            document.getElementById('url-field').style.display = 'none';
            $('#layername-field input').attr('required', false);
            $('#url-field input').attr('required', false);

            if(val == 'Esri'){
                document.getElementById('layername-field').style.display = 'flex';
                $('#layername-field input').attr('required', true);
            }else{
                document.getElementById('url-field').style.display = 'flex';
                $('#url-field input').attr('required', true);
                document.getElementById('minzoom-field').style.display = 'flex';
                document.getElementById('maxzoom-field').style.display = 'flex';
            }
        }
    }
</script>
@endsection