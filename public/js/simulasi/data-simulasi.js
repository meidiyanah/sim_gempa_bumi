var DataSimulasi = new class dataSimulasi {
    constructor(){
        this.dataObject = [];
        this.selected = false;
        this.koordinat = false;
        this.userAktif = false;
        this.isSelected = false;
        this.layerSimulasi = L.featureGroup();//.addTo(map);
        this.layerZoomMarking = L.featureGroup();//.addTo(map);
    }

    getObject(){
        return this.dataObject;
    }

    getObjectById(i) {
        var hasil = false;
        for (const data in this.dataObject) {
            let search = this.dataObject.map(function (d) { return d.properties.id_point }).indexOf(i);
            if (search >= 0) {
                hasil = this.dataObject[search];
            }
        }
        return hasil;
    }

    getObjectByIdUser(id_user){
        let data = [];
        if (this.dataObject) {
            for (const key of this.dataObject) {
                if (id_user) {
                    console.log(key.properties.id_user, id_user);
                    if(key.properties.id_user == id_user){
                        data.push(key);
                    }
                }
            }
        }
        return data;
    }

    selectOnMap(){
        this.selected = true;
        $('#menu-add-simulasi').hide();
        
        let marker = new L.Draw.Marker(map, {
            tooltipStart: 'Tentukan Lokasi',
        });
        marker.enable();

        map.on(L.Draw.Event.CREATED, this.eventCreated);
    }

    eventCreated = (evt) => {
        const layer = evt.layer;
        let latlng = layer.getLatLng();

        $('#latitude_simulasi').val(latlng.lat);
        $('#longitude_simulasi').val(latlng.lng);
        $('#menu-add-simulasi').show();
    }

    create(){
        //HARUS DI COBA HITUNG MANUAL BENER NGGA NYA BELUM TAU
        $('#menu-add-simulasi').hide();

        var random_id = Math.floor(Math.random() * (+1000 - +1)) + +1;
        var id_point = 'simulasi_'+this.userAktif.id+'_'+random_id;
        
        var nama = $('#nama_simulasi').val();
        var latitude = $('#latitude_simulasi').val();
        var longitude = $('#longitude_simulasi').val();
        var kedalaman = $('#kedalaman_simulasi').val();
        var ukuran = $('#ukuran_simulasi').val();

        var prop = {
            id_point: id_point,
            nama: nama,
            latitude: latitude,
            longitude: longitude,
            kedalaman: kedalaman,
            ukuran: ukuran,
            id_user: DataSimulasi.userAktif.id
        };

        var latlng = L.latLng(latitude, longitude);

        var radiusTerparah = this.kalkulasiRadius(kedalaman, ukuran, 1);
        var radiusMenengah = this.kalkulasiRadius(kedalaman, ukuran, 2);
        var radiusAman = this.kalkulasiRadius(kedalaman, ukuran, 3);
        
        //AREA TERDAMPAK 1 (MERAH)
        var areaCircle1 = L.circle(latlng, {
            color: '#e00000',
            fillColor: '#e00000',
            fillOpacity: 0.5,
            id_point: id_point,
            radius: radiusTerparah,
        });
    
        //AREA TERDAMPAK 2 (ORANGE)
        var areaCircle2 = L.circle(latlng, {
            color: '#d39b0b',
            fillColor: '#d39b0b',
            fillOpacity: 0.5,
            id_point: id_point,
            radius: radiusMenengah,
        });
    
        //AREA TERDAMPAK 3 (HIJAU)
        var areaCircle3 = L.circle(latlng, {
            color: '#2a6b47',
            fillColor: '#2a6b47',
            fillOpacity: 0.5,
            id_point: id_point,
            radius: radiusAman,
        });

        prop.radiusTerparah = radiusTerparah;
        prop.radiusMenengah = radiusMenengah;
        prop.radiusAman = radiusAman;
    
        //ADD LAYER POLYGON CIRCLE AREA 3
        this.layerSimulasi.addLayer(areaCircle3);
        areaCircle3.dragging?.disable();
        //ADD LAYER POLYGON CIRCLE AREA 2
        this.layerSimulasi.addLayer(areaCircle2);
        areaCircle2.dragging?.disable();
        //ADD LAYER POLYGON CIRCLE AREA 1
        this.layerSimulasi.addLayer(areaCircle1);
        areaCircle1.dragging?.disable();

        this.layerSimulasi.bringToFront();

        var object = {
            object1: areaCircle1,
            object2: areaCircle2,
            object3: areaCircle3
        };

        var obj = new objectSimulasi(
            object,
            prop
        );

        this.dataObject.push(obj);
        this.simpanDatabase(id_point);

        this.clearForm();

        return obj;
    }

    addObject(data){
        var id = data.id;
        var id_point = data.id_point;
        var nama = data.nama;
        var latitude = data.koory;
        var longitude = data.koorx;
        var kedalaman = data.kedalaman;
        var ukuran = data.ukuran;

        var prop = {
            id: id,
            id_point: id_point,
            nama: nama,
            latitude: latitude,
            longitude: longitude,
            kedalaman: kedalaman,
            ukuran: ukuran,
            id_user: data.id_user
        };

        if(data.nama_pengguna){
            var nama_pengguna = data.nama_pengguna;
            prop.nama_pengguna = nama_pengguna;
        }

        var latlng = L.latLng(latitude, longitude);

        var radiusTerparah = this.kalkulasiRadius(kedalaman, ukuran, 1);
        var radiusMenengah = this.kalkulasiRadius(kedalaman, ukuran, 2);
        var radiusAman = this.kalkulasiRadius(kedalaman, ukuran, 3);
        
        //AREA TERDAMPAK 1 (MERAH)
        var areaCircle1 = L.circle(latlng, {
            color: '#e00000',
            fillColor: '#e00000',
            fillOpacity: 0.5,
            id_point: id_point,
            radius: radiusTerparah,
        });
    
        //AREA TERDAMPAK 2 (ORANGE)
        var areaCircle2 = L.circle(latlng, {
            color: '#d39b0b',
            fillColor: '#d39b0b',
            fillOpacity: 0.5,
            id_point: id_point,
            radius: radiusMenengah,
        });
    
        //AREA TERDAMPAK 3 (HIJAU)
        var areaCircle3 = L.circle(latlng, {
            color: '#2a6b47',
            fillColor: '#2a6b47',
            fillOpacity: 0.5,
            id_point: id_point,
            radius: radiusAman,
        });

        prop.radiusTerparah = radiusTerparah;
        prop.radiusMenengah = radiusMenengah;
        prop.radiusAman = radiusAman;
    
        //ADD LAYER POLYGON CIRCLE AREA 3
        this.layerSimulasi.addLayer(areaCircle3);
        areaCircle3.dragging?.disable();
        //ADD LAYER POLYGON CIRCLE AREA 2
        this.layerSimulasi.addLayer(areaCircle2);
        areaCircle2.dragging?.disable();
        //ADD LAYER POLYGON CIRCLE AREA 1
        this.layerSimulasi.addLayer(areaCircle1);
        areaCircle1.dragging?.disable();

        this.layerSimulasi.bringToFront();

        var object = {
            object1: areaCircle1,
            object2: areaCircle2,
            object3: areaCircle3
        };

        var obj = new objectSimulasi(
            object,
            prop
        );

        this.dataObject.push(obj);

        return obj;
    }

    clearForm(){
        $('#nama_simulasi').val("");
        $('#latitude_simulasi').val("");
        $('#longitude_simulasi').val("");
        $('#kedalaman_simulasi').val("");
        $('#ukuran_simulasi').val("");
        $('#nama_simulasi_edit').val("");
        $('#latitude_simulasi_edit').val("");
        $('#longitude_simulasi_edit').val("");
        $('#kedalaman_simulasi_edit').val("");
        $('#ukuran_simulasi_edit').val("");
    }

    kalkulasiRadius(kedalaman, ukuran, tingkat){
        var intensitas = 0;
        if(tingkat == 1){
            intensitas = 10;
        }else if(tingkat == 2){
            intensitas = 7;
        }

        var magnitudo = Number(ukuran);
        var depth = Number(kedalaman);

        //JIKA INTENSITAS 6-12 -> Terparah dan Menengah
        if(intensitas > 6){
            //RUMUS : MMI => R = (10^((magnitudo/2)-1)) - 0.5 * (intensitas-6)) x (1/Math.sqrt(depth-6)) 
            var kal1 = magnitudo/2;
            var kal2 = intensitas - 6;
            var kal11 = kal1 - 1;
            var kal22 = 0.5 * kal2;
            var kal3 = kal11 - kal22;
            var kal33 = 10**kal3;

            //DENGAN KEDALAMAN
            var kal4 = depth + 1;
            var kal44 = Math.sqrt(kal4);
            var kal444 = 1 / kal44;
            var hasilAkhir = kal33 * kal444;
        }else{//JIKA INTENSITAS 1-5 -> Aman
            //RUMUS : MMI => R = (10^((magnitudo/2)-1)) x (1/Math.sqrt(depth-6)) 
            var kal1 = magnitudo/2;
            var kal11 = kal1 - 1;
            var kal33 = 10**kal11;

            //DENGAN KEDALAMAN
            var kal4 = depth + 1;
            var kal44 = Math.sqrt(kal4);
            var kal444 = 1 / kal44;
            var hasilAkhir = kal33 * kal444;
        }

        return hasilAkhir*1000;//SEBELUMNYA DALAM SATUAN KM DIUBAH KE M (DIKALI 1000)
    }

    simpanDatabase(id_point){
        var entity = DataSimulasi.getObjectById(id_point);
        var prop = entity.properties;
        
        prop._token = this.csrf_token;
        
        $.ajax({
            url: this.urlSimpan,
            type: "POST",
            data: prop,
            success: function(result) {
                if(prop.id && prop.id != null){//EDIT
                    alert("Proses Ubah Simulasi "+result);
                }else{//TAMBAH        
                    alert("Proses Simpan Simulasi "+result);
                }
            },
            error: function(result) {
                if(prop.id && prop.id != null){//EDIT
                    alert("Proses Ubah Simulasi "+result+", Terjadi kesalahan saat mengubah data simulasi");
                }else{//TAMBAH
                    alert("Proses Simpan Simulasi "+result+", Terjadi kesalahan saat menyimpan data simulasi");
                }
            }              
        });
    }

    editSimulasi(){
        $('#menu-info-simulasi').hide();

        var id_point = $('#id_simulasi_info').html();
        var entity = DataSimulasi.getObjectById(id_point);

        $('#nama_simulasi_edit').val(entity.properties.nama);
        $('#latitude_simulasi_edit').val(entity.properties.latitude);
        $('#longitude_simulasi_edit').val(entity.properties.longitude);
        $('#kedalaman_simulasi_edit').val(entity.properties.kedalaman);
        $('#ukuran_simulasi_edit').val(entity.properties.ukuran);

        $('#menu-edit-simulasi').show();
    }

    ubahSimulasi(){
        var id_point = $('#id_simulasi_info').html();
        var entity = DataSimulasi.getObjectById(id_point);

        var nama = $('#nama_simulasi_edit').val();
        var latitude = $('#latitude_simulasi_edit').val();
        var longitude = $('#longitude_simulasi_edit').val();
        var kedalaman = $('#kedalaman_simulasi_edit').val();
        var ukuran = $('#ukuran_simulasi_edit').val();

        var radiusTerparah = this.kalkulasiRadius(kedalaman, ukuran, 1);
        var radiusMenengah = this.kalkulasiRadius(kedalaman, ukuran, 2);
        var radiusAman = this.kalkulasiRadius(kedalaman, ukuran, 3);

        var data = {
            id_point: id_point,
            nama: nama,
            latitude: latitude,
            longitude: longitude,
            kedalaman: kedalaman,
            ukuran: ukuran,
            radiusTerparah: radiusTerparah,
            radiusMenengah: radiusMenengah,
            radiusAman: radiusAman
        };

        entity.edit(data);
    }

    hapusSimulasi(){
        var id_point = $('#id_simulasi_info').html();
        var entity = DataSimulasi.getObjectById(id_point);

        var confirm_ = confirm("Want to delete?");
        if (confirm_) {
            for (const data in this.dataObject) {
                let search = this.dataObject.map(function (d) { return d.properties.id_point }).indexOf(id_point);
                if (search >= 0) {
                    entity.clearInfo();
                    openMenu();
                    entity.remove();
                    this.dataObject.splice(search, 1);
                    //HAPUS DARI DATABASE
                    DataSimulasi.hapusDatabase(entity.properties.id);
                }
            }
        }
    }

    hapusDatabase(id){
        $.ajax({
            url: this.urlHapus,
            type: "POST",
            data: {id: id, _token: this.csrf_token},
            success: function(result) {
                alert("Hapus Simulasi "+result);
            },
            error: function(error) {
                console.log(error);
            }              
        });
    }

    batalAksi(){
        this.clearForm();
        $('#menu-edit-simulasi').hide();
        $('#menu-info-simulasi').show();
    }

    toggleShow(obj){
        var id_point = $(obj).data("item");
        var entity = DataSimulasi.getObjectById(id_point);
        
        if(entity){
            if ($(obj).is(":checked")) {
                entity.showObject();
            }else{
                entity.hideObject();
            }
        }
    }
};

class objectSimulasi{
    constructor(object, properties){
        this.object1 = object.object1;
        this.object2 = object.object2;
        this.object3 = object.object3;
        this.properties = properties;
        this.isPrimary = true;
        this.show = true;
    }

    hideObject(){
        //AREA 1
        DataSimulasi.layerSimulasi.removeLayer(this.object1);
        //AREA 2
        DataSimulasi.layerSimulasi.removeLayer(this.object2);
        //AREA 3
        DataSimulasi.layerSimulasi.removeLayer(this.object3);

        this.show = false;
    }

    showObject(){
        //AREA 3
        this.object3.addTo(DataSimulasi.layerSimulasi);
        this.object3.dragging?.disable();
        //AREA 2
        this.object2.addTo(DataSimulasi.layerSimulasi);
        this.object2.dragging?.disable();
        //AREA 1
        this.object1.addTo(DataSimulasi.layerSimulasi);
        this.object1.dragging?.disable();

        this.show = true;
        DataSimulasi.layerSimulasi.bringToFront();
    }

    showInfo() {
        this.clearInfo();

        $('#id_simulasi_info').html(this.properties.id_point);
        $('#nama_simulasi_info').html(this.properties.nama);
        $('#latitude_simulasi_info').html(this.properties.latitude);
        $('#longitude_simulasi_info').html(this.properties.longitude);
        $('#kedalaman_simulasi_info').html(this.properties.kedalaman);
        $('#ukuran_simulasi_info').html(this.properties.ukuran);

        var terparah = parseFloat(this.properties.radiusTerparah) / 1000;
        var menengah = parseFloat(this.properties.radiusMenengah) / 1000;
        var aman = parseFloat(this.properties.radiusAman) / 1000;
        $('#radiusTerparah_simulasi_info').html(parseFloat(terparah).toFixed(2)+" km");
        $('#radiusMenengah_simulasi_info').html(parseFloat(menengah).toFixed(2)+" km");
        $('#radiusAman_simulasi_info').html(parseFloat(aman).toFixed(2)+" km");

        openMenu('menu-info-simulasi');
    }

    clearInfo(){
        $('#id_simulasi_info').html("");
        $('#nama_simulasi_info').html("");
        $('#latitude_simulasi_info').html("");
        $('#longitude_simulasi_info').html("");
        $('#kedalaman_simulasi_info').html("");
        $('#ukuran_simulasi_info').html("");
        $('#radiusTerparah_simulasi_info').html("");
        $('#radiusMenengah_simulasi_info').html("");
        $('#radiusAman_simulasi_info').html("");
    }
    
    edit(data) {
        data.nama ? this.properties.nama = data.nama : false;
        data.latitude ? this.properties.latitude = data.latitude : false;
        data.longitude ? this.properties.longitude = data.longitude : false;
        data.kedalaman ? this.properties.kedalaman = data.kedalaman : false;
        data.ukuran ? this.properties.ukuran = data.ukuran : false;
        data.radiusTerparah ? this.properties.radiusTerparah = data.radiusTerparah : false;
        data.radiusMenengah ? this.properties.radiusMenengah = data.radiusMenengah : false;
        data.radiusAman ? this.properties.radiusAman = data.radiusAman : false;
  
        //AREA 1
        this.object1.setRadius(data.radiusTerparah);
        //AREA 2
        this.object2.setRadius(data.radiusMenengah);
        //AREA 3
        this.object3.setRadius(data.radiusAman);

        //CLEAR
        this.clearEdit();
        $('#menu-edit-simulasi').hide();
        this.showInfo();
    }

    clearEdit(){
        $('#nama_simulasi_edit').val("");
        $('#latitude_simulasi_edit').val("");
        $('#longitude_simulasi_edit').val("");
        $('#kedalaman_simulasi_edit').val("");
        $('#ukuran_simulasi_edit').val("");
    }

    remove(){
        //AREA 1
        DataSimulasi.layerSimulasi.removeLayer(this.object1);
        //AREA 2
        DataSimulasi.layerSimulasi.removeLayer(this.object2);
        //AREA 3
        DataSimulasi.layerSimulasi.removeLayer(this.object3);
    }
  
    getNamaObject(){
      return this.properties.nama;
    }
    getId(){
        return this.properties.id_point;
    }
  
  }