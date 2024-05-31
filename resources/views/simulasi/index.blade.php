<!DOCTYPE html>
<!--[if IE 9]> <html class="ie9 no-js" lang="en"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="{{ asset('/images/logo.png') }}">

    <title>SIMULASI JANGKAUAN GEMPA BUMI</title><!--SIJAPAI-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--FontAwesome 4.7.0  -->
    <link rel="stylesheet" href="{{asset('css/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/sweetalert2.css')}}">
    <link rel="stylesheet" href="{{ asset('/assets/select2/dist/css/select2.min.css') }}" />

    <!--LEAFLET JS-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

    <script type="text/javascript">
        document.documentElement.className = document.documentElement.className.replace('no-js', 'js') + (document.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#BasicStructure", "1.1") ? ' svg' : ' no-svg');
        </script>

    <link rel="stylesheet" href="{{ asset('/css/simulasi.css') }}" />

    <script src="{{asset('js/jquery/jquery-3.4.1.min.js')}}" crossorigin="anonymous"></script>
    <script src="{{asset('js/jquery/jquery-ui.min.js')}}" crossorigin="anonymous"></script>
    <script src="{{asset('js/jquery.form.js')}}"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="{{asset('js/simulasi/data-simulasi.js')}}"></script> 

    <!--LEAFLET JS-->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <!--LEAFLET DRAW JS-->
    <script src="{{ asset('component/leaflet-draw/Leaflet.draw.js') }}"></script>
    <script src="{{ asset('component/leaflet-draw/Leaflet.Draw.Event.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('component/leaflet-draw/leaflet.draw.css') }}"/>

    <!--DRAWING-->
    <script src="{{ asset('component/Toolbar.js') }}"></script>
    <script src="{{ asset('component/Tooltip.js') }}"></script>

    <script src="{{ asset('component/ext/GeometryUtil.js') }}"></script>
    <script src="{{ asset('component/ext/LatLngUtil.js') }}"></script>
    <script src="{{ asset('component/ext/LineUtil.Intersect.js') }}"></script>
    <script src="{{ asset('component/ext/Polygon.Intersect.js') }}"></script>
    <script src="{{ asset('component/ext/Polyline.Intersect.js') }}"></script>
    <script src="{{ asset('component/ext/TouchEvents.js') }}"></script>

    <script src="{{ asset('component/draw/DrawToolbar.js') }}"></script>
    <script src="{{ asset('component/draw/handler/Draw.Feature.js') }}"></script>
    <script src="{{ asset('component/draw/handler/Draw.SimpleShape.js') }}"></script>
    <script src="{{ asset('component/draw/handler/Draw.Polyline.js') }}"></script>
    <script src="{{ asset('component/draw/handler/Draw.Marker.js') }}"></script>
    <script src="{{ asset('component/draw/handler/Draw.Circle.js') }}"></script>
    <script src="{{ asset('component/draw/handler/Draw.CircleMarker.js') }}"></script>
    <script src="{{ asset('component/draw/handler/Draw.Polygon.js') }}"></script>
    <script src="{{ asset('component/draw/handler/Draw.Rectangle.js') }}"></script>
    <script src="{{ asset('component/draw/handler/Draw.PolylineRoute.js') }}"></script>
</head>
<body>
<div class="header">
    <img src="{{asset('images/icon-color.png')}}" width="30px">
    <span class="app-name">SIMULASI JANGKAUAN GEMPA BUMI</span>
    <div style="float: right; margin-right: 15%;">
        <a class="btn btn-info btn-sm" href="{{ url('/') }}">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>  Back End
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
    <div style="float: right; margin-right: 2%;">
        <a class="btn btn-secondary btn-sm" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-sign-out" aria-hidden="true"></i>  Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
</div>
<button class="btn btn-success btn-sm btn-add-simulasi" data-toggle="modal" data-target="#simulasiAdd" title="Buat Simulasi"><i class="fa fa-plus"></i></button>
<div class="container">
    <div id="map" style="position: fixed;inset: 0;z-index: 1;height: 100vh;width: 100%; transition: width .2s ease-in-out;"></div>
</div>

<!-- Modal -->
<div class="modal fade" id="simulasiAdd" tabindex="-1" role="dialog" aria-labelledby="simulasiAddLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="simulasiAddLabel">Buat Simulasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row" style="margin-top: 10px;">
            <div class="label col-md-2 label-popup-add">Koordinat</div>
            <div class="col-md-4">
                <input type="number" class="form-control" id="latitude" width="100%" placeholder="Latitude">
            </div>
            <div class="col-md-4">
                <input type="number" class="form-control" id="longitude" width="100%" placeholder="Longitude">
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary btn-select-map" onclick="DataSimulasi.selectOnMap()" title="Pilih Lokasi">Pilih Lokasi</button>
            </div>
        </div>
        <div class="row" style="margin-top: 10px;">
            <div class="label col-md-2 label-popup-add">Kedalaman</div>
            <div class="col-md-4">
                <div class="input-group">
                    <input type="number" id="kedalaman" width="100%" class="form-control" placeholder="Kedalaman" aria-label="Kedalaman" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">Km</span>
                    </div>
                </div> 
            </div>
        </div>
        <div class="row" style="margin-top: 10px;">
            <div class="label col-md-2 label-popup-add">Ukuran</div>
            <div class="col-md-4">
                <div class="input-group">
                    <input type="number" id="ukuran" width="100%" class="form-control" placeholder="Ukuran" aria-label="Ukuran" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">Magnitudo</span>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-success" onclick="DataSimulasi.create()">Buat Data</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
</body>
<script src="{{asset('js/simulasi/public.js')}}"></script>
</html>