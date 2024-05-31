<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use Illuminate\Http\Request;

class KotaController extends Controller
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
        $data = Kota::orderBy('id', 'ASC')->get();
        return view('back-end.kota.index', compact('data'));
    }

    public function create()
    {
        $jenis = 'Tambah';
        $url = 'data-kota.store';
        return view('back-end.kota.form', compact('jenis','url'));
    }

    public function store(Request $request)
    {
        $create = Kota::create([
            'nama_kota' => $request->nama_kota,
            'koorx' => $request->koorx,
            'koory' => $request->koory
        ]);
        
        return redirect()->route('data-kota.index')->with('status', 'Kota "'.$request->nama_kota.'" berhasil ditambahkan');
    }

    public function show($ids)
    {
        $id = base64_decode($ids);
        $jenis = 'Detail';
        $url = '';
        $data = Kota::where('id', $id)->first();
        return view('back-end.kota.form', compact('id','jenis','url','data'));
    }

    public function edit($ids)
    {
        $id = base64_decode($ids);
        $jenis = 'Edit';
        $url = 'data-kota.update';
        $data = Kota::where('id', $id)->first();
        return view('back-end.kota.form', compact('id','jenis','url','data'));
    }

    public function update($ids, Request $request)
    {
        $reqData = [];
        $reqData['nama_kota'] = $request->nama_kota;
        $reqData['koorx'] = $request->koorx;
        $reqData['koory'] = $request->koory;

        $upd = Kota::where('id', base64_decode($ids))->update($reqData);

        return redirect()->route('data-kota.index')->with('status', 'Kota "'.$request->nama_kota.'" berhasil diubah');
    }

    public function destroy($ids)
    {
        $cek = Kota::where('id', base64_decode($ids))->first()->nama_kota;
        $data = Kota::where('id', base64_decode($ids))->delete();
        return redirect()->route('data-kota.index')->with('status', 'Kota "'.$cek.'" berhasil dihapuskan');
    }
}
