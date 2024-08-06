var layerBasemap = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
});

var map = new L.map('map', { 
    center: new L.LatLng(-1, 118),
    zoom: 5,
    layers: [
        layerBasemap
    ]
});

DataSimulasi.layerSimulasi.addTo(map);
DataSimulasi.layerSimulasi.bringToFront();

var basemapLayer = false;
let toolsMenu = new L.Control.toolsMenu().addTo(map);
let scaleMenu = L.control.scale().addTo(map);
// Add Measurement polyline
let measureLineMenu = L.control.polylineMeasure ({position:'topleft', unit:'kilometres', showBearings:false, clearMeasurementsOnStop: false, showClearControl: true, showUnitControl: true})
measureLineMenu.addTo (map);

function openMenu(id = false) {
    if (document.getElementById('menu-add-simulasi')){
        document.getElementById('menu-add-simulasi').style.display = "none";
    } 
    if (document.getElementById('menu-basemapList')){
        document.getElementById('menu-basemapList').style.display = "none";
    } 
    if (document.getElementById('menu-simulasi')){
        document.getElementById('menu-simulasi').style.display = "none";
    }
    if (document.getElementById('menu-kota')){
        document.getElementById('menu-kota').style.display = "none";
    }
    if (document.getElementById('menu-location')){
        document.getElementById('menu-location').style.display = "none";
    }
    if (document.getElementById('menu-info-simulasi')){
        document.getElementById('menu-info-simulasi').style.display = "none";
    }

    if (id) {
        document.getElementById(id).style.display = "block";
    }
}

function showPeta(obj, esri){
    if($(obj).is(":checked")){
        let index = $(obj).data("item");
        let layer = false;
        if(index == "default"){
            layer = layerBasemap;
        }else{
            dataPeta.forEach(element => {
                if(parseInt(element.id) == parseInt(index)){
                    if (element.jenis == "Arcgis Online") {
                        layer = L.esri.tiledMapLayer({
                            url: element.url,
                            pane: "overlayPane",
                            maxZoom: (element.max_zoom) ? element.max_zoom : 25,
                            attribution: element.nama,
                        })
                    } else if(element.jenis == 'Esri'){
                        layer = L.esri.basemapLayer(element.layer_name);
                    } else {
                        layer = L.tileLayer(element.url, {
                            maxZoom: (element.max_zoom) ? element.max_zoom : 25,
                            attribution: element.nama
                        });
                    }

                    return layer;
                }
            });
        }

        if(basemapLayer){
            basemapLayer.remove();
        }else{
            basemapLayer = layer;
        }

        map.addLayer(layer);
    }
}

function pilihKota(value) {
    var data = JSON.parse(atob(value));
    $('#nama_longlat').html(data.nama_kota);
    $('#lat_longlat').html(data.koory);
    $('#long_longlat').html(data.koorx);

    var latlng = L.latLng(data.koorx, data.koory);
    map.flyTo(latlng, 13);
}

function pilih_convert(value) {
    document.getElementById("longlat_convert").style.display = "none";
    document.getElementById("dms_convert").style.display = "none";
    if (value == 1) {
        document.getElementById("longlat_convert").style.display = "block";
    } else if (value == 2) {
        document.getElementById("dms_convert").style.display = "block";
    }

    clear_hasil();
}

function clear_hasil() {
    // document.getElementById("eas_hasil").value = "";
    // document.getElementById("nort_hasil").value = "";
    // document.getElementById("zone_hasil").value = "";
    // document.getElementById("convert_2_long").value = "";
    // document.getElementById("convert_2_lat").value = "";
    // document.getElementById("long_hasil").value = "";
    // document.getElementById("lat_hasil").value = "";
}

function zoomToCoor() {
    let nilaiKoordinat = document.getElementById("nilai_koordinat").value;
    if (nilaiKoordinat == 1) {
        let lng = document.getElementById("longitude_convert").value;
        let lat = document.getElementById("latitude_convert").value;

        let latLng = L.latLng(lat, lng);

        let marker = L.marker(latLng)
        .bindPopup(`lat: ${latLng.lat}<br>lng: ${latLng.lng}<br><button class="btn btn-outline-danger btn-sm" onclick="clearWaypoint()">Close</button>`)
        .addTo(DataSimulasi.layerZoomMarking);

        marker.openPopup();

        map.flyTo(latLng, 13);
    } else if (nilaiKoordinat == 2) {
        var d_lat = document.getElementById("d_lat_convert").value;
        var m_lat = document.getElementById("m_lat_convert").value;
        var s_lat = document.getElementById("s_lat_convert").value;
        var arah_lat = document.getElementById("arah_lat_convert").value;

        var d_long = document.getElementById("d_long_convert").value;
        var m_long = document.getElementById("m_long_convert").value;
        var s_long = document.getElementById("s_long_convert").value;
        var arah_long = document.getElementById("arah_long_convert").value;

        var latitude = 0;
        var longitude = 0;

        if (arah_lat == "n" && arah_long == "e") {
            latitude = (Number(d_lat) + ((m_lat / 60) + (s_lat / 3600)));
            longitude = (Number(d_long) + ((m_long / 60) + (s_long / 3600)));
        } else if (arah_lat == "s" && arah_long == "e") {
            var dd = (Number(d_lat) + ((m_lat / 60) + (s_lat / 3600)));
            latitude = (dd * (-1));
            longitude = (Number(d_long) + ((m_long / 60) + (s_long / 3600)));
        } else if (arah_lat == "n" && arah_long == "w") {
            latitude = (Number(d_lat) + ((m_lat / 60) + (s_lat / 3600)));
            var de = (Number(d_long) + ((m_long / 60) + (s_long / 3600)));
            longitude = (de * (-1));
        } else if (arah_lat == "s" && arah_long == "w") {
            var dd = (Number(d_lat) + ((m_lat / 60) + (s_lat / 3600)));
            var de = (Number(d_long) + ((m_long / 60) + (s_long / 3600)));
            longitude = (de * (-1));
            latitude = (dd * (-1));
        } else {

        }
        latitude = Number(latitude);
        longitude = Number(longitude);

        let latLng = L.latLng(latitude, longitude);

        let marker = L.marker(latLng)
        .bindPopup(`lat: ${latLng.lat}<br>lng: ${latLng.lng}`)
        .addTo(DataSimulasi.layerZoomMarking);

        marker.openPopup();

        map.flyTo(latLng, 13); 
    }
}

function clearLayerZoomMarking() {
    DataSimulasi.layerZoomMarking.clearLayers();
    document.getElementById("longitude_convert").value = "";
    document.getElementById("latitude_convert").value = "";
    document.getElementById("d_lat_convert").value = "";
    document.getElementById("m_lat_convert").value = "";
    document.getElementById("s_lat_convert").value = "";
    document.getElementById("d_long_convert").value = "";
    document.getElementById("m_long_convert").value = "";
    document.getElementById("s_long_convert").value = "";
}

//CLICK VISUALISASI SIMULASI
DataSimulasi.layerSimulasi.on("click", function(evt){
    var layer_click = evt.layer;
    if(layer_click instanceof L.Circle){
        if(typeof layer_click.options !== 'undefined'){
            if(typeof layer_click.options.id_point !== 'undefined'){
                var id_point = layer_click.options.id_point;
                var entity = DataSimulasi.getObjectById(id_point);

                entity.showInfo();
            }
        }
    }
}); 

function toggleSimulasi(type, id) {
    if (type === 'show') {
        $(`#toggleSub_${id}`).html(`<i class="fa fa-caret-up" onclick="toggleSimulasi('hide', '${id}')"></i>`);
        $(`#dataSimulasi_${id}`).show();
    } else {
        $(`#toggleSub_${id}`).html(`<i class="fa fa-caret-down" onclick="toggleSimulasi('show', '${id}')"></i>`);
        $(`#dataSimulasi_${id}`).hide();
    }
}

function daftarSimulasiAdmin() {
    document.getElementById("daftar_simulasi").innerHTML = "";

    var html = "";
    //REFERENSI DATA
    html += `<div class="card p-1 w-100 mb-2">
                <div class="media-body">
                    <div class="d-flex flex-row justify-content-between" id="data-referensi">
                        <h8 class="mb-0 text-truncate" style="width: 100%;"><b>REFERENSI (BMKG)</b></h8>
                        <span id="toggleSub_bmkg" style="margin-right: 5px;">
                            <i class="fa fa-caret-down" onclick="toggleSimulasi('show', 'bmkg')"></i>
                        </span>
                    </div>
                    <ul id="dataSimulasi_bmkg" style="font-size: 15px; display: none; margin-top: 10px;">`;

    var referensi = DataSimulasi.getObject('referensi');
    if(referensi.length > 0){
        for (const [k, data] of referensi.entries()) {
            var daerah = data.properties.nama.replace(/-/g, ' - ');
            html += `<li class="d-flex justify-content-between" style="position: relative;">
                        <span style="font-size: 12px;" class="mb-0 text-truncate" style="width: calc(100% - 40px);">`+daerah+`</span>
                        <div class="d-flex flex-row-reverse" style="position: absolute; top: 0; right: 0;">
                            <div class="custom-control custom-switch" style="margin-right: 10px;">
                                <input type="checkbox" class="custom-control-input" id="checkSimulasi_`+data.properties.id_point+`" data-item="`+data.properties.id_point+`" onclick="DataSimulasi.toggleShow(this)">
                                <label class="custom-control-label" for="checkSimulasi_`+data.properties.id_point+`">&nbsp;</label>
                            </div>
                        </div>
                    </li>`;
        }
    }else{
        html +=  `<li class="d-flex justify-content-between" style="position: relative;">
                    <h8 class="mb-0 text-truncate" style="width: calc(100% - 40px); margin-left: 50px;">Data Kosong</h8>
                    </li>`;
    }

    html += `</ul>
        </div>
    </div>`;

    //DATA SIMULASI USER
    if(dataUsers.length > 0){
        for (const [i, user] of dataUsers.entries()) {
            html += `<div class="card p-1 w-100 mb-1">
                        <div class="media-body">
                            <div class="d-flex flex-row justify-content-between" id="simulasi_`+user.name+`">
                                <h8 class="mb-0 text-truncate" style="width: 100%;">`+user.name+`</h8>
                                <span id="toggleSub_`+user.id+`" style="margin-right: 5px;">
                                    <i class="fa fa-caret-down" onclick="toggleSimulasi('show', `+user.id+`)"></i>
                                </span>
                            </div>
                            <ul id="dataSimulasi_`+user.id+`" style="font-size: 15px; display: none; margin-top: 10px;">`;

            var datas = DataSimulasi.getObjectByIdUser(user.id);
            if(datas.length > 0){
                for (const [k, data] of datas.entries()) {
                    html += `<li class="d-flex justify-content-between" style="position: relative;">
                                <h8 class="mb-0 text-truncate" style="width: calc(100% - 40px);">`+data.properties.nama+`</h8>
                                <div class="d-flex flex-row-reverse" style="position: absolute; top: 0; right: 0;">
                                    <div class="custom-control custom-switch" style="margin-right: 10px;">
                                        <input type="checkbox" class="custom-control-input" id="checkSimulasi_`+data.properties.id_point+`" data-item="`+data.properties.id_point+`" onclick="DataSimulasi.toggleShow(this)">
                                        <label class="custom-control-label" for="checkSimulasi_`+data.properties.id_point+`">&nbsp;</label>
                                    </div>
                                </div>
                            </li>`;
                }
            }else{
                html +=  `<li class="d-flex justify-content-between" style="position: relative;">
                            <h8 class="mb-0 text-truncate" style="width: calc(100% - 40px); margin-left: 50px;">Data Kosong</h8>
                          </li>`;
            }

            html += `</ul>
                </div>
            </div>`;
        }
    }

    document.getElementById("daftar_simulasi").innerHTML = html;
}

function daftarSimulasi() {
    document.getElementById("daftar_simulasi").innerHTML = "";

    var html = '';

    //REFERENSI DATA
    html += `<div class="card p-1 w-100 mb-2">
                <div class="media-body">
                    <div class="d-flex flex-row justify-content-between" id="data-referensi">
                        <h8 class="mb-0 text-truncate" style="width: 100%;"><b>REFERENSI (BMKG)</b></h8>
                        <span id="toggleSub_bmkg" style="margin-right: 5px;">
                            <i class="fa fa-caret-down" onclick="toggleSimulasi('show', 'bmkg')"></i>
                        </span>
                    </div>
                    <ul id="dataSimulasi_bmkg" style="font-size: 15px; display: none; margin-top: 10px;">`;

    var referensi = DataSimulasi.getObject('referensi');
    if(referensi.length > 0){
        for (const [k, data] of referensi.entries()) {
            var daerah = data.properties.nama.replace(/-/g, ' - ');
            html += `<li class="d-flex justify-content-between" style="position: relative;">
                        <span style="font-size: 12px;" class="mb-0 text-truncate" style="width: calc(100% - 40px);">`+daerah+`</span>
                        <div class="d-flex flex-row-reverse" style="position: absolute; top: 0; right: 0;">
                            <div class="custom-control custom-switch" style="margin-right: 10px;">
                                <input type="checkbox" class="custom-control-input" id="checkSimulasi_`+data.properties.id_point+`" data-item="`+data.properties.id_point+`" onclick="DataSimulasi.toggleShow(this)">
                                <label class="custom-control-label" for="checkSimulasi_`+data.properties.id_point+`">&nbsp;</label>
                            </div>
                        </div>
                    </li>`;
        }
    }else{
        html +=  `<li class="d-flex justify-content-between" style="position: relative;">
                    <h8 class="mb-0 text-truncate" style="width: calc(100% - 40px); margin-left: 50px;">Data Kosong</h8>
                    </li>`;
    }

    html += `</ul>
        </div>
    </div>`;

    //DATA SIMULASI USER
    var allData = DataSimulasi.getObject('simulasi');
    if(allData.length > 0){
        for (const [i, adata] of allData.entries()) {
            var checked = '';
            if(adata.show){
                checked = 'checked';
            }

            var data = adata.properties;

            var name = data.nama;
            if(data.nama_pengguna){
                name = data.nama+"("+data.nama_pengguna+")";
            }

            html += '<div class="card p-1" style="margin: 0 5px 3px 5px !important;">\
                        <div class="media-body">\
                            <div class="d-flex flex-row justify-content-between">\
                                <h8 class="mb-0">'+name+'</h8>\
                                <span>\
                                    <div class="custom-control custom-switch">\
                                        <input type="checkbox" class="custom-control-input SradioBtn_'+data.id_point+'"" id="SradioBtn_'+data.id_point+'" data-item="'+data.id_point+'" onclick="DataSimulasi.toggleShow(this)" '+checked+'>\
                                        <label class="custom-control-label" for="SradioBtn_'+data.id_point+'">&nbsp;</label>\
                                    </div>\
                                </span>\
                            </div>\
                        </div>\
                    </div>';
        }
    }else{
        html += '<div class="card p-1" style="margin: 0 5px 0 5px !important;">\
                    <div class="media-body" style="text-align: center;">\
                        - Data Simulasi Kosong -\
                    </div>\
                </div>';
    }
    document.getElementById("daftar_simulasi").innerHTML = html;
}

function getCityName(lat, lon, status) {
    var url = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lon}`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            var nama = '-';
            if (data) {
                if(data.display_name != ""){
                    nama = data.display_name;
                }
            }

            if(status == 'create'){
                $('#daerah_simulasi').val(nama);
            }else{
                $('#daerah_simulasi_info').html(nama);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}