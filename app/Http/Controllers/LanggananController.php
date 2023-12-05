<?php

namespace App\Http\Controllers;

use App\Models\Langganan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LanggananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $langganan = Langganan::latest()->paginate(10);
        return view('backend.langganan.index', compact('langganan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'=> 'required',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator->messages());
        };
        $langganan = Langganan::create([
            'email' => $request->email,
        ]);
        if ($langganan) {
            return redirect()->to('/')->withSuccess('Berhasil berlangganan');
        } else {
            return back()->withInput()->withErrors('Gagal berlangganan');
        };
    }

    /**
     * Display the specified resource.
     */
    public function show(Langganan $langganan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Langganan $langganan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Langganan $langganan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Langganan $langganan)
    {
        $langganan->delete();

        if ($langganan) {
            return back()->withSuccess('Berhasil Delete');
        } else {
            return back()->withErrors('Gagal Delete');
        };
    }
}
