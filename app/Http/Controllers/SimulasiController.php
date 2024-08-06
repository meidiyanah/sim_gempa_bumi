<?php

namespace App\Http\Controllers;

use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Peta;
use App\Models\Kota;
use App\Models\Simulasi;

class SimulasiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataPeta = Peta::orderBy('id', 'ASC')->get();
        $dataKota = Kota::orderBy('id', 'ASC')->get();

        if(Auth::user()->jenis_user == 1){//ADMIN MENAMPILKAN SEMUA DATA SIMULASI
            $dataSimulasi = Simulasi::join('users', 'users.id', '=', 'simulasi.id_user')->selectRaw('simulasi.*, users.name as nama_pengguna')->orderBy('id', 'ASC')->get();
        }else{//USER MENAMPILKAN DATA SIMULASI MILIK DIRINYA SENDIRI
            $dataSimulasi = Simulasi::where('id_user', Auth::user()->id)->orderBy('id', 'ASC')->get();
        }

        //SUMBER : BMKG (Badan Meteorologi, Klimatologi, dan Geofisika)
        $referensi = [];
        $data = simplexml_load_file("https://data.bmkg.go.id/DataMKG/TEWS/gempaterkini.xml");//15 DATA GEMPA TERKINI
        if($data){
            $count = 0;
            foreach($data->gempa as $g) {
                $tanggal = date('d-m-Y', strtotime($g->DateTime));
                $jam = date('H:i:s', strtotime(explode(' ', $g->Jam)[0]));
                $koordinat = explode(',', $g->point->coordinates);
                $wilayah = explode(' ', $g->Wilayah);

                $obj = [
                    'id' => $count+1,
                    'id_point' => 'referensi_'.($count+1),
                    'tanggal' => $tanggal.' '.$jam,
                    'koorx' => $koordinat[1],
                    'koory' => $koordinat[0],
                    'ukuran' => (float)$g->Magnitude,
                    'kedalaman' => (float)$g->Kedalaman,
                    'nama' => $wilayah[count($wilayah)-1],
                    'referensi' => true
                ];
                array_push($referensi, $obj);
                $count++;
            }
        }

        $dataUsers = User::where('jenis_user', 2)->whereNull('deleted_at')->orderBy('name', 'ASC')->get();

        return view('simulasi.index', compact('dataPeta', 'dataKota', 'dataSimulasi', 'dataUsers', 'referensi'));
    }
    
    public function store(Request $req)
    {
        date_default_timezone_set("Asia/Bangkok");

        if($req->id){
            $simpan = Simulasi::where('id', $req->id)->update([
                'id_user' => $req->id_user,
                'nama' => $req->nama,
                'koorx' => $req->longitude,
                'koory' => $req->latitude,
                'kedalaman' => $req->kedalaman,
                'ukuran' => $req->ukuran,
                'id_point' => $req->id_point,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            $idnya = $req->id;
        }else{
            $simpan = Simulasi::insertGetId([
                'id_user' => $req->id_user,
                'nama' => $req->nama,
                'koorx' => $req->longitude,
                'koory' => $req->latitude,
                'kedalaman' => $req->kedalaman,
                'ukuran' => $req->ukuran,
                'id_point' => $req->id_point,
                'created_at' => date('Y-m-d H:i:s')
            ]);
            $idnya = $simpan;
        }

        if($simpan){
            return response()->json(['Berhasil', $idnya]);
            die();
        }else{
            return response()->json(['Gagal']);
            die();
        }
        
    }

    public function destroy(Request $req)
    {
        $id = $req->id;
        $hapus = Simulasi::where('id', $id)->delete();

        if($hapus){
            echo "Berhasil";
        }else{
            echo "Gagal";
        }

        die();
    }
}
