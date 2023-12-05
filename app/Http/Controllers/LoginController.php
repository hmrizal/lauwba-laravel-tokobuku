<?php

namespace App\Http\Controllers;

use App\Models\Tentang;
use App\Models\Sosmed;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function users()
    {
        if (Auth::check()) {
            return redirect()->to('/backend');
        }
        return view('backend.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::id() == 1) {
                return redirect()->intended('/backend/dashboard')->withSuccess('Berhasil Login');
            } else {
                return redirect()->intended('/')->withSuccess('Berhasil Login');
            }
        } else {
            return back()->withErrors('Gagal Login');
        }
    }

    public function show()
    {
        $data = [
            'tentang' => Tentang::first(),
            'sosmed' => Sosmed::all(),
        ];

        return view('frontend.login.index', $data);
    }

    public function logout(Request $request): RedirectResponse
    {
        $data = Auth::user();

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->intended('/login')->withSuccess('Berhasil Logout');

    }

    // public function logoutCustomer(Request $request): RedirectResponse
    // {
    //     Auth::user()->id!=1;

    //     Auth::logout();

    //     $request->session()->invalidate();

    //     $request->session()->regenerateToken();

    //     return redirect()->intended('/login')->withSuccess('Berhasil Logout');

    // }

    /**
     * Store a newly created resource in storage.
     */
    public function welcome()
    {
        return view('backend.welcome');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator->messages());
        };
        $customer = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        if ($customer) {
            return redirect()->to('/login')->withSuccess('User tersimpan');
        } else {
            return back()->withInput()->withErrors('User gagal tersimpan');
        };
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
