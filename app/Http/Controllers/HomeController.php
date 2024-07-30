<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use App\Models\Peta;
use App\Models\Kota;
use App\Models\User;
use App\Models\Simulasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        date_default_timezone_set('Asia/Bangkok');

        if(Auth::user()->jenis_user == 1){//ADMIN MENAMPILKAN SEMUA DATA SIMULASI
            $dataSimulasi = Simulasi::orderBy('id', 'ASC')->count();
            $dataPeta = Peta::orderBy('id', 'ASC')->count();
            $dataKota = Kota::orderBy('id', 'ASC')->count();
            $dataPengguna = User::whereNull('deleted_at')->orderBy('id', 'ASC')->count();

            $dataSimulasiMonth = 0;
            $dataSimulasiYear = 0;
        }else{//USER MENAMPILKAN DATA SIMULASI MILIK DIRINYA SENDIRI
            //KOSONG
            $dataPeta = 0;
            $dataKota = 0;
            $dataPengguna = 0;
            $dataSimulasi = Simulasi::where('id_user', Auth::user()->id)->orderBy('id', 'ASC')->count();
            //datasimulasi bulan ini
            $dataSimulasiMonth = Simulasi::whereMonth('created_at', '=', date('m'))->where('id_user', Auth::user()->id)->orderBy('id', 'ASC')->count();
            //datasimulasi tahun ini
            $dataSimulasiYear = Simulasi::whereYear('created_at', '=', date('Y'))->where('id_user', Auth::user()->id)->orderBy('id', 'ASC')->count();
        }

        $dataMonth = [];
        for ($i=1; $i <= 12; $i++) { 
            $month = ($i < 10) ? '0'.$i:$i;
            $count = Simulasi::whereMonth('created_at', '=', $month);
            if(Auth::user()->jenis_user == 2){
                $count = $count->where('id_user', Auth::user()->id);
            }
            $count = $count->count();
            $dataMonth[$i] = $count;
        }

        return view('back-end.dashboard', compact('dataSimulasi', 'dataPeta', 'dataKota', 'dataMonth', 'dataSimulasiMonth', 'dataSimulasiYear', 'dataPengguna'));
    }

    public function profile()
    {
        $id = Auth::user()->id;
        $data = User::where('id', $id)->first();
        $jenis = DB::table('jenis_user')->orderBy('id', 'ASC')->get();
        return view('back-end.profile', compact('id', 'data', 'jenis'));
    }

    public function profile_update(Request $request) 
    {
        if($request->get('password')){
            $request->validate([
                "password" => "required",
                "confirm_password" => "required|same:password"
            ]);
        }

        $id = Auth::user()->id;

        $new_user = [];
        $new_user['name'] = $request->get('name');
        // $new_user['jenis_user'] = $request->get('jenis_user');
        $new_user['email'] = $request->get('email');
        $new_user['password'] = Hash::make($request->get('password'));
        // $new_user['status'] = $request->get('status');

        $upd = User::where('id', $id)->update($new_user);

        if ($request->file('avatar')) {
			$file = $request->file('avatar');
            if (!empty($file)) {
                $ori_name = $file->getClientOriginalName();
                $ext = pathinfo($ori_name, PATHINFO_EXTENSION);
                // $filename=$asd['nama_skenario'] . "_" . Auth::guard('webmaster')->user()->name . $idlss . "." . $ext;
                $filename = $ori_name;
                $file->move(
                    public_path('/images/avatars/' . $id . '/'),
                    $filename
                );

                $updFile = User::where('id', $id)->update(['avatar' => $filename]);
            }
        }

        return redirect()->route('profile.index')->with('status', 'Profil berhasil diubah');
    }

    public function password()
    {
        return view('back-end.change_password');
    }

    public function password_update(Request $request) 
    {
        $request->validate([
            "password" => "required",
            "confirm_password" => "required|same:password"
        ]);

        $id = Auth::user()->id;

        $new_user = [];
        $new_user['password'] = Hash::make($request->get('password'));

        $upd = User::where('id', $id)->update($new_user);

        return redirect()->route('password.index')->with('status', 'Password berhasil diubah');
    }
}
