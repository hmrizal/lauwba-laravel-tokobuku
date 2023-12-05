<?php

namespace App\Http\Controllers;

use App\Models\Tentang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TentangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tentang = Tentang::all();
        return view('backend.tentang.index', compact('tentang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.tentang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lokasi'=> 'required',
            'telp'=> 'required',
            'email'=> 'required',
            'deskripsi'=> 'required'
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator->messages());
        };
        $tentang = Tentang::create([
            'lokasi' => $request->lokasi,
            'telp' => $request->telp,
            'email' => $request->email,
            'deskripsi' => $request->deskripsi
        ]);
        if ($tentang) {
            return redirect()->to('/backend/tentang')->withSuccess('Berhasil Ditambah');
        } else {
            return back()->withInput()->withErrors('Gagal Ditambah');
        };
    }

    /**
     * Display the specified resource.
     */
    public function show(Tentang $tentang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tentang $tentang)
    {
        return view('backend.tentang.edit', compact('tentang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tentang $tentang)
    {
        $ten = [
            'lokasi' => $request->lokasi,
            'telp' => $request->telp,
            'email' => $request->email,
            'deskripsi' => $request->deskripsi
        ];

        $tentang->update($ten);

        if ($tentang) {
            return redirect()->to('/backend/tentang')->withSuccess('Berhasil Update');
        } else {
            return back()->withInput()->withErrors('Gagal Update');
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tentang $tentang)
    {
        //
    }
}
