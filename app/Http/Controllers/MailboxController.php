<?php

namespace App\Http\Controllers;

use App\Models\Mailbox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MailboxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mailbox = Mailbox::latest()->paginate(10);
        return view('backend.mailbox.index', compact('mailbox'));
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
            'nama'=> 'required',
            'email'=> 'required',
            'judul'=> 'required',
            'pesan'=> 'required'
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator->messages());
        };
        $mailbox = Mailbox::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'judul' => $request->judul,
            'pesan' => $request->pesan
        ]);
        if ($mailbox) {
            return redirect()->to('/contact')->withSuccess('Pesan terkirim');
        } else {
            return back()->withInput()->withErrors('Pesan gagal terkirim');
        };
    }

    /**
     * Display the specified resource.
     */
    public function show(Mailbox $mailbox)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mailbox $mailbox)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mailbox $mailbox)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mailbox $mailbox)
    {
        $mailbox->delete();

        if ($mailbox) {
            return back()->withSuccess('Berhasil Delete');
        } else {
            return back()->withErrors('Gagal Delete');
        };
    }
}
