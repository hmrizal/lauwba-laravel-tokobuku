<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Tentang;
use App\Models\Sosmed;
use App\Models\Genre;
use App\Models\DasarBuku;
use App\Models\DetailBuku;
use Illuminate\Support\Facades\DB;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tentang = Tentang::first();
        $sosmed = Sosmed::all();
        $fiction = Genre::where('genre', 'Fiction')->get();
        $nonfiction = Genre::where('genre', 'Nonfiction')->get();
        $books = DasarBuku::query();
        // dd($books);

        $isCustomerAuthenticated = Auth::check();

        $customer = $isCustomerAuthenticated ? Auth::user() : null; // Get the authenticated customer or null

        // Apply filters
        if ($request->has('subgenre')) {
            $books->whereHas('genre', function ($query) use ($request) {
                $query->where('subgenre', $request->input('subgenre'));
            });
        }

        if ($request->has('price_range')) {
            $priceRange = explode('-', $request->input('price_range'));
            // $books->whereBetween('harga_asli', $priceRange);
            $books->where(function ($query) use ($priceRange) {
                // Filter non-discounted books within the price range
                $query->whereBetween('harga_asli', $priceRange)->whereNull('diskon');

                // Filter discounted books within the price range
                $query->orWhere(function ($query) use ($priceRange) {
                    $query->whereBetween(DB::raw('(harga_asli * (100 - COALESCE(diskon, 0)) / 100)'), $priceRange);
                });
            });
        }

        // Apply search filter
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $books->where('judul', 'like', '%' . $searchTerm . '%');
        }

        // Apply sorting
        $order = $request->input('order', 'asc');
        $sortField = $request->input('sort', 'judul');

        $books->orderBy($sortField, $order);

        // Paginate the results
        $perPage = 9;
        $books = $books->paginate($perPage);

        // $search = $request->input('search');
        // if ($search) {
        //     $books = DasarBuku::where('judul', 'like', '%' . $search . '%')->paginate();
        // } else {
        //     $books = DasarBuku::paginate();
        // }

        // dd($hasilCari);
        return view('frontend.books.index', compact('tentang', 'sosmed', 'fiction', 'nonfiction', 'books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function search(Request $request)
    // {
    // }


    public function filterBySubgenre($subgenre)
    {
        return $this->index(request()->merge(['subgenre' => $subgenre]));
    }

    public function filterByPrice($range)
    {
        return $this->index(request()->merge(['price_range' => $range]));
    }

    public function sortByTitle($order)
    {
        return $this->index(request()->merge(['sort' => 'judul', 'order' => $order]));
    }

    public function sortByPrice($order)
    {
        return $this->index(request()->merge(['sort' => 'harga_asli', 'order' => $order]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy($range, Request $request)
    {
        // $tentang = Tentang::first();
        // $sosmed = Sosmed::all();
        // $fiction = Genre::where('genre', 'Fiction')->get();
        // $nonfiction = Genre::where('genre', 'Nonfiction')->get();
        // $books = DasarBuku::all();

        // $books = $books->filter(function($item) use ($range) {
        //     $range = explode('-', $range);
        //         if($item->diskon > 0){
        //             $harga_diskon = (100-$item->diskon)/100*$item->harga_asli;
        //             if ($harga_diskon >= $range[0] && $harga_diskon <= $range[1]){
        //                 return $item;
        //             }
        //         } else {
        //             if($item->harga_asli >= $range[0] && $item->harga_asli <= $range[1]){
        //                 return $item;
        //             }
        //         }

        // });
        // // dd($books);

        // return view('frontend.books.index', compact('tentang', 'sosmed', 'fiction', 'nonfiction', 'books'));

    }


}
