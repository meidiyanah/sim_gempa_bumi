<?php

namespace App\Http\Controllers;

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

        $dataUsers = User::where('jenis_user', 2)->orderBy('name', 'ASC')->get();

        return view('simulasi.index', compact('dataPeta', 'dataKota', 'dataSimulasi', 'dataUsers'));
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
        }else{
            $simpan = Simulasi::insert([
                'id_user' => $req->id_user,
                'nama' => $req->nama,
                'koorx' => $req->longitude,
                'koory' => $req->latitude,
                'kedalaman' => $req->kedalaman,
                'ukuran' => $req->ukuran,
                'id_point' => $req->id_point,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }

        if($simpan){
            echo "Berhasil";
            die();
        }else{
            echo "Gagal";
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
