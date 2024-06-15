<?php

namespace App\Http\Controllers;

use Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
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
        $data = User::join('jenis_user', 'jenis_user.id', '=', 'users.jenis_user')->selectRaw('users.*, jenis_user.jenis_user as jenis_pengguna')->whereNull('deleted_at')->orderBy('jenis_user', 'ASC')->orderBy('id', 'ASC')->get();
        return view('back-end.user.index', compact('data'));
    }

    public function create()
    {
        $jenis = 'Tambah';
        $url = 'data-user.store';
        $jenis_user = DB::table('jenis_user')->orderBy('id', 'ASC')->get();
        return view('back-end.user.form', compact('jenis','url', 'jenis_user'));
    }

    public function store(Request $request)
    {
        if($request->get('password')){
            $request->validate([
                "password" => "required",
                "confirm_password" => "required|same:password"
            ]);
        }

        $new_user = [];
        $new_user['name'] = $request->get('name');
        $new_user['jenis_user'] = $request->get('jenis_user');
        $new_user['email'] = $request->get('email');
        $new_user['password'] = Hash::make($request->get('password'));
        $new_user['status'] = $request->get('status');

        $save = User::insertGetId($new_user);

        if ($request->file('avatar')) {
			$file = $request->file('avatar');
            if (!empty($file)) {
                $ori_name = $file->getClientOriginalName();
                $ext = pathinfo($ori_name, PATHINFO_EXTENSION);
                // $filename=$asd['nama_skenario'] . "_" . Auth::guard('webmaster')->user()->name . $idlss . "." . $ext;
                $filename = $ori_name;
                $file->move(
                    public_path('/images/avatars/' . $save . '/'),
                    $filename
                );

                $saveFile = User::where('id', $save)->update(['avatar' => $filename]);
            }
        }

        return redirect()->route('data-user.index')->with('status', 'Data Pengguna atas nama '.$request->get('name').' berhasil ditambahkan');
    }

    public function show($ids)
    {
        $id = base64_decode($ids);
        $jenis = 'Detail';
        $url = '';
        $data = User::where('id', $id)->first();
        $jenis_user = DB::table('jenis_user')->orderBy('id', 'ASC')->get();
        return view('back-end.user.form', compact('id','jenis','url','data', 'jenis_user'));
    }

    public function edit($ids)
    {
        $id = base64_decode($ids);
        $jenis = 'Edit';
        $url = 'data-user.update';
        $data = User::where('id', $id)->first();
        $jenis_user = DB::table('jenis_user')->orderBy('id', 'ASC')->get();
        return view('back-end.user.form', compact('id','jenis','url','data', 'jenis_user'));
    }

    public function update($ids, Request $request)
    {
        if($request->get('password')){
            $request->validate([
                "password" => "required",
                "confirm_password" => "required|same:password"
            ]);
        }

        $id = base64_decode($ids);

        $new_user = [];
        $new_user['name'] = $request->get('name');
        $new_user['jenis_user'] = $request->get('jenis_user');
        $new_user['email'] = $request->get('email');
        $new_user['password'] = Hash::make($request->get('password'));
        $new_user['status'] = $request->get('status');

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

        return redirect()->route('data-user.index')->with('status', 'Data Pengguna atas nama '.$request->get('name').' berhasil diubah');
    }

    public function destroy($ids)
    {
        $cek = User::where('id', base64_decode($ids))->first()->name;
        $data = User::where('id', base64_decode($ids))->update(['deleted_at' => date('Y-m-d H:i:s')]);
        return redirect()->route('data-user.index')->with('status', 'Data Pengguna atas nama "'.$cek.'" berhasil dihapuskan');
    }
}
