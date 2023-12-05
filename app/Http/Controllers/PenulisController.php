<?php

namespace App\Http\Controllers;

use App\Models\Penulis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PenulisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penulis = Penulis::paginate(10);
        return view('backend.penulis.index', compact('penulis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.penulis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_penulis'=> 'required',
            'foto'=> 'required',
            'nama'=> 'required',
            'biografi'=> 'required',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator->messages());
        };
        $foto = $request->file('foto');
        $path = Storage::putFile('public/foto_penulis', $foto);
        $penulis = Penulis::create([
            'id_penulis' => $request->id_penulis,
            'foto' => $path,
            'nama'=> $request->nama,
            'biografi'=> $request->biografi,
        ]);
        if ($penulis) {
            return redirect()->to('/backend/penulis')->withSuccess('Berhasil Ditambah');
        } else {
            return back()->withInput()->withErrors('Gagal Ditambah');
        };
    }

    /**
     * Display the specified resource.
     */
    public function show(Penulis $penulis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penulis $penulis)
    {
        return view('backend.penulis.edit', compact('penulis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penulis $penulis)
    {
        if ($request->hasFile('foto')) {
            if (Storage::get($penulis->foto)) {
                Storage::delete($penulis->foto);
            }
            $foto = $request->file('foto');
            $path = Storage::putFile('public/cover_buku', $foto);
            $penulis->foto = $path;
        }
        $pen = [
            'nama' => $request->nama,
            'biografi' => $request->biografi
        ];

        $penulis->update($pen);

        if ($penulis) {
            return redirect()->to('/backend/penulis')->withSuccess('Berhasil Update');
        } else {
            return back()->withInput()->withErrors('Gagal Update');
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penulis $penulis)
    {
        if (Storage::get($penulis->foto)) {
            Storage::delete($penulis->foto);
        }
        $penulis->delete();

        if ($penulis) {
            return back()->withSuccess('Berhasil Delete');
        } else {
            return back()->withErrors('Gagal Delete');
        };
    }

}
