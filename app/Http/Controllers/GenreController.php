<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genre = Genre::paginate(10);
        return view('backend.genre.index', compact('genre'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.genre.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_genre'=> 'required',
            'genre'=> 'required',
            'subgenre'=> 'required',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator->messages());
        };
        $genre = Genre::create([
            'id_genre' => $request->id_genre,
            'genre' => $request->genre,
            'subgenre'=> $request->subgenre,
        ]);
        if ($genre) {
            return redirect()->to('/backend/genre')->withSuccess('Berhasil Ditambah');
        } else {
            return back()->withInput()->withErrors('Gagal Ditambah');
        };
    }

    /**
     * Display the specified resource.
     */
    public function show(Genre $genre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genre $genre)
    {
        return view('backend.genre.edit', compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Genre $genre)
    {
        $gen = [
            'genre' => $request->genre,
            'subgenre' => $request->subgenre
        ];

        $genre->update($gen);

        if ($genre) {
            return redirect()->to('/backend/genre')->withSuccess('Berhasil Update');
        } else {
            return back()->withInput()->withErrors('Gagal Update');
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();

        if ($genre) {
            return back()->withSuccess('Berhasil Delete');
        } else {
            return back()->withErrors('Gagal Delete');
        };
    }
}
