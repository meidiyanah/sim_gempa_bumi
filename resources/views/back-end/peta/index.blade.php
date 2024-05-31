@extends('layouts.app-back-end')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Peta</h1>
<br>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> -->
        <a href="{{route('data-peta.create')}}" class="btn btn-success btn-icon-split"  style="float: right;">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Tambah Data</span>
        </a>
    </div>
    <div class="card-body">
        @if(session('status'))
            <div class="alert alert-success">
                <button style="float: right;" type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{session('status')}}
            </div>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width: 10% !important;">No</th>
                        <th style="width: 20% !important;">Nama Peta</th>
                        <!-- <th style="width: 20% !important;">URL</th> -->
                        <th style="width: 40% !important;">Nama Layer / URL</th>
                        <th style="width: 15% !important;">Jenis</th>
                        <th style="width: 15% !important;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($data) && count($data) > 0)
                        @foreach($data as $key => $pt)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$pt->nama}}</td>
                                <!-- <td>{{$pt->url}}</td> -->
                                <td>@if($pt->url == null){{$pt->layer_name}}@else{{$pt->url}}@endif</td>
                                <td>{{$pt->jenis}}</td>
                                <td align="center">
                                    <a href="{{route('data-peta.show', base64_encode($pt->id))}}" class="btn btn-info btn-circle btn-sm" title="Detail"><i class="fa fa-list"></i></a>
                                    <a class="btn btn-warning btn-circle btn-sm text-white" href="{{route('data-peta.edit', base64_encode($pt->id))}}"  title="Edit"><i class="fa fa-edit"></i></a>
                                    <button type="button" onclick="hapusData('{{base64_encode($pt->id)}}')" class="btn btn-danger btn-circle btn-sm text-white" title="Hapus"><i class="fa fa-trash"></i></button>

                                    <form id="form-hapus-{{base64_encode($pt->id)}}" class="d-inline" action="{{route('data-peta.destroy', base64_encode($pt->id))}}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <th colspan="5">- Tidak ada Data -</th>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
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
</script>
@endsection