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

map.on(L.Draw.Event.CREATED, function(evt){
    if(DataSimulasi.selected){
        console.log(evt.layer);
        // var latlng = map.mouseEventToLatLng(ev.originalEvent);

        // var lat = latlng.lat;
        // var lng = latlng.lng;

        // $('#latitude').val(lat);
        // $('#longitude').val(lng);
        // $('#simulasiAdd').modal('show');
    }
});