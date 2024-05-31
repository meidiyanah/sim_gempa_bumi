<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peta;

class PetaController extends Controller
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
        $data = Peta::orderBy('id', 'ASC')->get();
        return view('back-end.peta.index', compact('data'));
    }

    public function create()
    {
        $jenis = 'Tambah';
        $url = 'data-peta.store';
        return view('back-end.peta.form', compact('jenis','url'));
    }

    public function store(Request $request)
    {
        $create = Peta::create([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'url' => $request->url,
            'layer_name' => $request->layer_name,
            'min_zoom' => $request->min_zoom,
            'max_zoom' => $request->max_zoom
        ]);
        return redirect()->route('data-peta.index')->with('status', 'Peta "'.$request->nama.'" berhasil ditambahkan');
    }

    public function show($ids)
    {
        $id = base64_decode($ids);
        $jenis = 'Detail';
        $url = '';
        $data = Peta::where('id', $id)->first();
        return view('back-end.peta.form', compact('id','jenis','url','data'));
    }

    public function edit($ids)
    {
        $id = base64_decode($ids);
        $jenis = 'Edit';
        $url = 'data-peta.update';
        $data = Peta::where('id', $id)->first();
        return view('back-end.peta.form', compact('id','jenis','url','data'));
    }

    public function update($ids, Request $request)
    {
        $reqData = [];
        $reqData['nama'] = $request->nama;
        $reqData['jenis'] = $request->jenis;

        if($request->jenis == 'Esri'){
            $reqData['url'] = NULL;
            $reqData['layer_name'] = $request->layer_name;
            $reqData['min_zoom'] = NULL;
            $reqData['max_zoom'] = NULL;
        }else{
            $reqData['url'] = $request->url;
            $reqData['layer_name'] = NULL;
            $reqData['min_zoom'] = $request->min_zoom;
            $reqData['max_zoom'] = $request->max_zoom;
        }

        $upd = Peta::where('id', base64_decode($ids))->update($reqData);

        return redirect()->route('data-peta.index')->with('status', 'Peta "'.$request->nama.'" berhasil diubah');
    }

    public function destroy($ids)
    {
        $cek = Peta::where('id', base64_decode($ids))->first()->nama;
        $data = Peta::where('id', base64_decode($ids))->delete();
        return redirect()->route('data-peta.index')->with('status', 'Peta "'.$cek.'" berhasil dihapuskan');
    }
}
