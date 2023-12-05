<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Tentang;
use App\Models\Sosmed;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customer = User::latest()->paginate(10);
        return view('backend.customer.index', compact('customer'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    // public function authenticate(Request $request): RedirectResponse
    // {
    //     $credentials = $request->validate([
    //         'email' => ['required', 'email'],
    //         'password' => ['required'],
    //     ]);


    //     if ($customer = Customer::where('email', $credentials['email'])->first()) {
    //         if (Hash::check($credentials['password'], $customer->password)) {
    //             session()->put('id', $customer->id_customer);
    //             session()->put('nama', $customer->nama);
    //             session()->put('alamat', $customer->alamat);
    //             session()->put('kodepos', $customer->kodepos);
    //             session()->put('telp', $customer->telp);
    //             return redirect()->intended('/')->withSuccess('Berhasil Login');
    //         } else {
    //             return back()->withErrors('Password salah');
    //         }
    //     } else {
    //         return back()->withErrors('Username salah');
    //     }
    // }

    // public function welcome()
    // {
    //     return view('frontend.index');
    // }

    // public function logout(Request $request): RedirectResponse
    // {
    //     Auth::logout();

    //     $request->session()->invalidate();

    //     $request->session()->regenerateToken();

    //     return redirect('/');
    // }

    /**
     * Store a newly created resource in storage.
     */
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

    // public function users()
    // {
    //     if (Auth::check()) {
    //         return redirect()->to('/');
    //     }
    //     return view('frontend.index');
    // }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        $data = [
            'tentang' => Tentang::first(),
            'sosmed' => Sosmed::all(),
        ];

        return view('frontend.login.index', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        if ($customer) {
            return back()->withSuccess('Berhasil Delete');
        } else {
            return back()->withErrors('Gagal Delete');
        };
    }
}
