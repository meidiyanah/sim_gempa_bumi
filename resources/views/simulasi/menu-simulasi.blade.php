<div id="menu-info-simulasi" style="display: none;" class="menu_info">
	<div class="headerInfo">
        <button class="btn btn-danger btn-sm" title="Tutup Menu" onclick="openMenu()" style="float: left;"><i class="fa fa-times"></i></button>
		INFORMASI
	</div>
    <div class="informasi">
        <div class="label1">
            <div class="labelInfo text-white">Nama</div>
            <div class="Info text-white">: <span id="nama_simulasi_info">-</span></div>
            <div class="Info text-white" hidden>: <span id="id_simulasi_info">-</span></div>
        </div>
    </div>
    <div class="informasi">
        <div class="label1">
            <div class="labelInfo text-white">Latitude</div>
            <div class="Info text-white">: <span id="latitude_simulasi_info">-</span></div>
        </div>
    </div>
    <div class="informasi">
        <div class="label1">
            <div class="labelInfo text-white">Longitude</div>
            <div class="Info text-white">: <span id="longitude_simulasi_info">-</span></div>
        </div>
    </div>
    <div class="informasi">
        <div class="label1">
            <div class="labelInfo text-white">Kedalaman</div>
            <div class="Info text-white">: <span id="kedalaman_simulasi_info">-</span></div>
        </div>
    </div>
    <div class="informasi">
        <div class="label1">
            <div class="labelInfo text-white">Ukuran (Magnitudo)</div>
            <div class="Info text-white">: <span id="ukuran_simulasi_info">-</span></div>
        </div>
    </div>
    <div class="informasi">
        <table class="table table-bordered" width="100%" style="margin-bottom: 0px !important;">
            <tr>
                <th style="text-align: center;">Tingkat</th>
                <th style="text-align: center;">Radius</th>
                <!-- <th style="text-align: center;">Persentase</th> -->
            </tr>
            <tr>
                <td>Terparah (<i class="fa fa-circle" aria-hidden="true" style="color: red;"></i>)</td>
                <td style="text-align: center;"><span id="radiusTerparah_simulasi_info">-</span></td>
                <!-- <td style="text-align: center;"><span id="persenTerparah_simulasi_info">-</span></td> -->
            </tr>
            <tr>
                <td>Menengah (<i class="fa fa-circle" aria-hidden="true" style="color: orange;"></i>)</td>
                <td style="text-align: center;"><span id="radiusMenengah_simulasi_info">-</span></td>
                <!-- <td style="text-align: center;"><span id="persenMenengah_simulasi_info">-</span></td> -->
            </tr>
            <tr>
                <td>Aman (<i class="fa fa-circle" aria-hidden="true" style="color: green;"></i>)</td>
                <td style="text-align: center;"><span id="radiusAman_simulasi_info">-</span></td>
                <!-- <td style="text-align: center;"><span id="persenAman_simulasi_info">-</span></td> -->
            </tr>
        </table>
    </div>
    @if(Auth::user()->jenis_user == 2)
    <div class="footerInfo">
        <div class="buttonInfo" onclick="DataSimulasi.editSimulasi()">Ubah data</div>
        <div class="buttonInfo buttonInfo-error" style="float: right;" onclick="DataSimulasi.hapusSimulasi()">Hapus</div>
    </div>
    @endif
</div>

<div id="menu-edit-simulasi" style="display: none;" class="menu_info">
	<div class="headerInfo">
		UBAH DATA
	</div>
    <div class="informasi">
        <div class="label1">
            <div class="labelInfo text-white">Nama :</div>
            <div class="Info"><input class="form-control" type="text" name="" id="nama_simulasi_edit"></div>
        </div>
    </div>
    <div class="informasi">
        <div class="label1">
            <div class="labelInfo text-white">Latitude :</div>
            <div class="Info"><input class="form-control" type="number" id="latitude_simulasi_edit"></div>
        </div>
    </div>
    <div class="informasi">
        <div class="label1">
            <div class="labelInfo text-white">Longitude :</div>
            <div class="Info"><input class="form-control" type="number" id="longitude_simulasi_edit"></div>
        </div>
    </div>
    <div class="informasi">
        <div class="label1">
            <div class="labelInfo text-white">Kedalaman :</div>
            <div class="Info"><input class="form-control" type="number" id="kedalaman_simulasi_edit"></div>
        </div>
    </div>
    <div class="informasi">
        <div class="label1">
            <div class="labelInfo text-white">Ukuran (Magnitudo) :</div>
            <div class="Info"><input class="form-control" type="number" id="ukuran_simulasi_edit"></div>
        </div>
    </div>
    <div class="footerInfo">
        <div class="buttonInfo" onclick="DataSimulasi.ubahSimulasi()">Simpan</div>
        <div class="buttonInfo buttonInfo-error" style="float: right;" onclick="DataSimulasi.batalAksi()">Batal</div>
    </div>
</div>