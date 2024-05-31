class dataSimulasi {
    constructor(){
        this.selected = false;
        this.koordinat = false;
        this.tmp_jalur = false;
        this.drawJalurMisi = false;
        this.tmp_panah = false;
        this.isSelected = false;
        this.damage = 250;
        this.jenisLain = ['btu', 'blo', 'linud', 'mobud', 'zeni', 'btk', 'pergerakan_disabling', 'disabling_airfield', 'disabling_harbour', 'carpet_bombing','penembakan','kemampuanzeni'];
        this.tmpBoundMisi = false;
        this.markerTembakBTK = false;
        this.tmpJalurBTK = false;
        this.tmpCircle1 = false;//Max
        this.tmpCircle2 = false;//Min
        this.tmpCircle1Turf = false;//Max
        this.tmpCircle2Turf = false;//Min
        this.titikObjekBTK = false;
    }

    create(){
        var latitude = $('#latitude').val();
        var longitude = $('#longitude').val();
        var kedalaman = $('#kedalaman').val();
        var ukuran = $('#ukuran').val();
        console.log("Masuk Sini", latitude, longitude, kedalaman, ukuran);
    }

    selectOnMap(){
        this.selected = true;
        
        let marker = new L.Draw.Marker(map);
        marker.enable();

        map.on(L.Draw.Event.CREATED, this.eventCreated);
    }
}


var DataSimulasi = new dataSimulasi();