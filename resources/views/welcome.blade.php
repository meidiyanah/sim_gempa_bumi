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
    <link rel="stylesheet" href="{{asset('polished/polished.min.css')}}">
    <link rel="stylesheet" href="{{asset('polished/iconic/css/open-iconic-bootstrap.min.css')}}">
    <style>
        body{
            background-image: url("images/bg-min4.jpg");
            height: 100%; /* You must set a specified height */
            background-position: center; /* Center the image */
            background-repeat: no-repeat; /* Do not repeat the image */
            background-size: cover;
        }
        .container{
            background: rgba(0,0,0,.3);
            height:100%;
        }
    </style>
    <script type="text/javascript">
    document.documentElement.className = document.documentElement.className.replace('no-js', 'js') + (document.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#BasicStructure", "1.1") ? ' svg' : ' no-svg');
    </script>
</head>
<body>
<div class="container">
    <div class="container-fluid h-100 p-0">
        <div style="min-height: 100%" class="flex-row d-flex align-items-stretch m-0">
            
            <div class="col-lg-12 col-md-9 pt-4 pl-3 pb-5 mb-4">
                <br><br><br><br>
                <div class="row pl-3 pt-2 mb-4">
                    <div class="col-12">
                    <center>
                        <!-- <img src="{{ url('images/logo.png')}}" width=100 alt=""><br><br> -->
                        <h1 style="color:#ffffff; font-weight: bolder;">DASHBOARD<br>SIMULASI JANGKAUAN GEMPA BUMI </h1>
                    </center>
                    </div>
                </div><br><br>

                <!-- START INFO BOX WITH MORE INFO -->
                <div class="row pl-3 pt-2 mb-4">
            
                    <div class="col-lg-6 col-md-6 mb-2 col-sm-6">
                        <div class="card border-0 shadow-sm bg-secondary text-dark">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body">
                                        <center>
                                            <h4>SIMULASI</h4>
                                            <img src="{{ url('images/icon-black.png')}}" alt="" width="200px">
                                        </center>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer border-0 text-center p-1 bg-dark-lighter">
                                @if(isset(Auth::user()->id))
                                    <a href="{{ url('/simulasi') }}" class="text-secondary">
                                        Masuk <span class="oi oi-arrow-circle-right"></span>
                                    </a>
                                @else
                                    <a href="{{ url('/login') }}" class="text-secondary">
                                        Login <span class="oi oi-arrow-circle-right"></span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 mb-2 col-sm-6">
                        <div class="card border-0 shadow-sm bg-secondary text-dark">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body">
                                        <center>
                                            <h4>USER MANUAL</h4>
                                            <img src="{{ url('images/timesheet.png')}}" alt="" width="200px">
                                        </center>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer border-0 text-center p-1 bg-dark-lighter">
                                <a href="{{ url('/user-manual') }}" class="text-secondary">
                                    Lihat  <span class="oi oi-arrow-circle-right"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END INFO BOX WITH MORE INFO -->
            </div>
        </div>
    </div>
</div>
</body>
</html>