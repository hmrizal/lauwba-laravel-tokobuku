<?php

namespace App\Http\Controllers;

use App\Models\Sosmed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SosmedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sosmed = Sosmed::all();
        return view('backend.sosmed.index', compact('sosmed'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.sosmed.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'facebook'=> 'required',
            'instagram'=> 'required',
            'twitter'=> 'required',
            'linkedin'=> 'required',
            'youtube'=> 'required'
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator->messages());
        };
        $sosmed = Sosmed::create([
            'facebook' => $request->facebook,
            'instagram'=> $request->instagram,
            'twitter'=> $request->twitter,
            'linkedin'=> $request->linkedin,
            'youtube'=> $request->youtube
        ]);
        if ($sosmed) {
            return redirect()->to('/backend/sosmed')->withSuccess('Berhasil Ditambah');
        } else {
            return back()->withInput()->withErrors('Gagal Ditambah');
        };
    }

    /**
     * Display the specified resource.
     */
    public function show(Sosmed $sosmed)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sosmed $sosmed)
    {
        return view('backend.sosmed.edit', compact('sosmed'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sosmed $sosmed)
    {
        $sos = [
            'facebook' => $request->facebook,
            'instagram'=> $request->instagram,
            'twitter'=> $request->twitter,
            'linkedin'=> $request->linkedin,
            'youtube'=> $request->youtube
        ];

        $sosmed->update($sos);

        if ($sosmed) {
            return redirect()->to('/backend/sosmed')->withSuccess('Berhasil Update');
        } else {
            return back()->withInput()->withErrors('Gagal Update');
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sosmed $sosmed)
    {
        $sosmed->delete();

        if ($sosmed) {
            return back()->withSuccess('Berhasil Delete');
        } else {
            return back()->withErrors('Gagal Delete');
        };
    }
}
