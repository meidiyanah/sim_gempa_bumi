<div class="menu-left" id="menu-add-simulasi" style="display: none; height: auto; top: 16.5%; width: auto;">
    <div class="h-100 no-radius">
        <div class="header-menu">
            <button class="close-right btn-danger" title="Tutup Menu" onclick="openMenu()"><i class="fa fa-times"></i></button>
            <!-- <span>List Basemap</span> -->
            <span>TAMBAH SIMULASI</span>
        </div>
        <div class="left-body" style="margin: 10px;">
            <div class="row-fluid">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label class="text-white">Nama</label>
                        <input type="text" id="nama_simulasi" class="form-control" title="Nama Simulasi">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label class="text-white">Latitude</label>
                        <input type="number" id="latitude_simulasi" class="form-control" placeholder="0" title="Latitude">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="text-white">Longitude</label>
                        <input type="number" id="longitude_simulasi" class="form-control" placeholder="0" title="Longitude">
                    </div>
                    <div class="form-group col-md-2">
                    <label class="text-white">&nbsp;</label>
                        <button class="btn btn-primary btn-select-map" onclick="DataSimulasi.selectOnMap()" title="Pilih Lokasi">Pilih Lokasi</button>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label class="text-white">Kedalaman</label>
                        <div class="input-group">
                            <input type="number" id="kedalaman_simulasi" width="100%" class="form-control" title="Kedalaman" placeholder="0" aria-label="Kedalaman" aria-describedby="basic-addon3">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon3">Km</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-5">
                        <label class="text-white">Ukuran (Magnitudo)</label>
                        <div class="input-group">
                            <input type="number" id="ukuran_simulasi" width="100%" class="form-control" title="Ukuran" placeholder="0" aria-label="Ukuran" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">Magnitudo</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-fluid" style="margin-bottom: 20px;">
                <button class="btn btn-primary" onclick="DataSimulasi.create()">
                    Simpan <span id="button-add-simulasi"></span>
                </button>
                <button class="btn btn-secondary text-white" onclick="DataSimulasi.clearForm()" style="margin-left: 5px;">
                    Reset <span id="button-reset-simulasi"></span>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="menu-left" id="menu-basemapList" style="display: none; height: 350px; top: 18.5%;">
    <div class="h-100 no-radius">
        <div class="header-menu">
            <button class="close-right btn-danger" title="Tutup Menu" onclick="openMenu()"><i class="fa fa-times"></i></button>
            <!-- <span>List Basemap</span> -->
            <span>DAFTAR PETA</span>
        </div>
        <div class="left-body" id="daftar_basemap" style="overflow: auto;max-height: 315px;">
            
        </div>
    </div>
</div>

<div class="menu-left" id="menu-simulasi" style="display: none; height: 350px; top: 22.5%;">
    <div class="h-100 no-radius">
        <div class="header-menu">
            <button class="close-right btn-danger" title="Tutup Menu" onclick="openMenu()"><i class="fa fa-times"></i></button>
            <!-- <span>List Basemap</span> -->
            <span>DAFTAR SIMULASI</span>
        </div>
        <div class="left-body" id="daftar_simulasi" style="overflow: auto;max-height: 315px; margin: 5px;">
            
        </div>
    </div>
</div>

<div class="menu-left" id="menu-kota" style="display: none; height: 350px; top: 26.5%;">
    <div class="h-100 no-radius">
        <div class="header-menu">
            <button class="close-right btn-danger" title="Tutup Menu" onclick="openMenu()"><i class="fa fa-times"></i></button>
            <!-- <span>List Basemap</span> -->
            <span>CARI KOTA</span>
        </div>
        <div class="left-body" id="">
            <div class="form_menu" style="padding: 5px;">
                <div class="input-group">
                    <label class="input-group-text" for="nama_kota_new"><b>KOTA</b></label>
                    <select id="nama_kota_new" class="form-control select2" data-placeholder="Pilih Kota" onchange="pilihKota(this.value)">
                        
                    </select>
                </div>

                <div id="form_pencarian" style="margin-top: 15px;">
                    <div class="card p-1">
                        <div class="media-body">
                            <div class="form_menu">
                                <p>
                                    <b>Kota = </b>
                                    <span id="nama_longlat" style="font-size: 18px;">-</span>
                                </p>
                                <div>
                                    <span><b>Koordinat</b></span>
                                    <table style="width: 100%;">
                                        <tr>
                                            <td width="35%">Latitude (Y)</td>
                                            <td width="5%">:</td>
                                            <td id="lat_longlat">-</td>
                                        </tr>
                                        <tr>
                                            <td width="35%">Longitude (X)</td>
                                            <td width="5%">:</td>
                                            <td id="long_longlat">-</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="menu-left" id="menu-location" style="display: none; height: auto; top: 30.5%; width: auto;">
    <div class="h-100 no-radius">
        <div class="header-menu">
            <button class="close-right btn-danger" title="Tutup Menu" onclick="openMenu()"><i class="fa fa-times"></i></button>
            <!-- <span>List Basemap</span> -->
            <span>CARI LOKASI</span>
        </div>
        <div class="left-body" style="margin: 10px;">
            <div class="row-fluid">
                <div class="form-row" style="width: 100%; margin-bottom: 10px;">
                    <div class="form-group col-md-12">
                        <select id="nilai_koordinat" onchange="pilih_convert(this.value)" class="form-control">
                            <option value="1">LongLat</option>
                            <option value="2">Geografis</option>
                        </select>
                    </div>
                </div>
                <div id="longlat_convert" style="display: block;float: left; width: 350px;">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="text-white">Latitude</label>
                            <!-- <input type="number" id="latitude_convert" class="form-control" value="0" placeholder="Latitude" title="Latitude"> -->
                            <input type="number" id="latitude_convert" class="form-control" placeholder="0" title="Latitude">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="text-white">Longitude</label>
                            <!-- <input type="number" id="longitude_convert" class="form-control" value="0" placeholder="Longitude" title="Longitude"> -->
                            <input type="number" id="longitude_convert" class="form-control" placeholder="0" title="Longitude">
                        </div>
                    </div>
                </div>
                <div id="dms_convert" style="display: none;float: left; width: 350px;">
                    <label class="text-white" style="font-weight: bold; text-decoration: underline; margin-bottom: 5px;">Latitude</label>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label class="text-white">Degrees</label>
                            <input type="number" placeholder="0" id="d_lat_convert" style="width: 100%;" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label class="text-white">Minute</label>
                            <input type="number" placeholder="0" id="m_lat_convert" style="width: 100%;" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label class="text-white">Seconds</label>
                            <input type="number" placeholder="0" id="s_lat_convert" style="width: 100%;" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label class="text-white">&nbsp;</label>
                            <select class="form-control" style="width: 100%;" id="arah_lat_convert">
                                <option value="n">N</option>
                                <option value="s">S</option>
                            </select>
                        </div>
                    </div>
                    <label class="text-white" style="font-weight: bold; text-decoration: underline; margin-bottom: 5px;">Longitude</label>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label class="text-white">Degrees</label>
                            <input type="number" placeholder="0" id="d_long_convert" style="width: 100%;" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label class="text-white">Minute</label>
                            <input type="number" placeholder="0" id="m_long_convert" style="width: 100%;" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label class="text-white">Seconds</label>
                            <input type="number" placeholder="0" id="s_long_convert" style="width: 100%;" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label class="text-white">&nbsp;</label>
                            <select class="form-control" style="width: 100%;" id="arah_long_convert">
                                <option value="e">E</option>
                                <option value="w">W</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-fluid" style="margin-bottom: 20px;">
                <button class="btn btn-primary" onclick="zoomToCoor()">
                    Cari <span id="button_convert"></span>
                </button>
                <button class="btn btn-secondary text-white" onclick="clearLayerZoomMarking()" style="margin-left: 5px;">
                    Reset <span id="button_clearLayerZoomMarking"></span>
                </button>
            </div>
        </div>
    </div>
</div>