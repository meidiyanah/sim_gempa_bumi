L.Control.toolsMenu = L.Control.extend({
    options: {
        position: 'topleft'
    },
    onAdd: function(map){
        this.map = map;
        this._container = document.createElement('div');
        this._container.className = 'toolsMenu-main';

        // disable event
        L.DomEvent.on(this._container, 'mousewheel', L.DomEvent.stopPropagation);
        L.DomEvent.on(this._container, 'mousemove', L.DomEvent.stopPropagation);
        L.DomEvent.disableClickPropagation(this._container);

        // Bagian atas
        this.menu = document.createElement('div');
        this.menu.className = 'menuUtama';

        // menu
        this.createMenu('images/plus.png', '#D5E8D4', 'Buat Simulasi', 'tambah-simulasi', () => {
            openMenu('menu-add-simulasi');
        })

        this.createMenu('images/basemap.png', '#DAE8FC', 'Daftar Peta', 'daftar-peta', () => {
            openMenu('menu-basemapList');
        })

        this.createMenu('images/list-simulasi.png', '#FFE6CC', 'Daftar Simulasi', 'daftar-simulasi', () => {
            if(DataSimulasi.userAktif.jenis_user == 1){
                daftarSimulasiAdmin();
            }else{
                daftarSimulasi();
            }
            openMenu('menu-simulasi');
        })

        this.createMenu('images/cari-kota.png', '#E1D5E7', 'Cari Kota', 'cari-kota', () => {
            openMenu('menu-kota');
        })

        this.createMenu('images/cari-lokasi.png', '#FFF2CC', 'Cari Lokasi', 'cari-lokasi', () => {
            openMenu('menu-location');
        })

        this._container.appendChild(this.menu);

        return this._container;
    },

    createMenu(options, color = false, title, nameId, callback){
        let btnMenu = document.createElement('div');
        btnMenu.className = 'btn-menu';
        btnMenu.setAttribute("id", nameId);
        if(color){
            btnMenu.style.backgroundColor = color;
        }
        if(options.url){
            btnMenu.classList.add('img-tools');
            btnMenu.style.backgroundImage = `url(${options.url})`;
            btnMenu.style.backgroundPosition = `${options.position[0]}px ${options.position[1]}px`;
        }else{
            btnMenu.innerHTML = `<img src="${options}" style="height: 100%;"/>`;
        }
        btnMenu.title = title;
        btnMenu.onclick = callback;

        this.menu.appendChild(btnMenu);
    },

})