<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use App\Models\Tentang;
use App\Models\Sosmed;
use App\Models\DetailBuku;
use App\Models\DasarBuku;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UlasanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        // Check if the customer is logged in
        if (!Auth::check()) {
            return redirect()->route('customer.login')->with('error', 'Please log in to review this book.');
        }

        $dasarBuku = DasarBuku::where('id_buku', $id)->get();
        // dd($dasarBuku);
        // $data = [
        $tentang = Tentang::first();
        $sosmed= Sosmed::all();
        $detailBuku= DetailBuku::where('id_buku', $id)->get();
        $averageRating = Ulasan::where('id_buku', $id)->avg('rating');
        $totalReviews = Ulasan::where('id_buku', $id)->count();
        $customerReviews = Ulasan::where('id_buku', $id)->paginate(10);
        // ];

        // dd($dasarBuku);
        return view('frontend.ulasan.create', compact('dasarBuku', 'tentang', 'sosmed', 'detailBuku', 'averageRating', 'totalReviews', 'customerReviews'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $dasarBuku = DasarBuku::where('id_buku', $bookId)->get();
        $request->validate([
            'rating' => 'required',
            'ulasan' => 'required',
        ]);

        // dd($request->rating);

        // Create a new review
        $ul = Ulasan::create([
            'id_buku' => $request->id_buku,
            'id' => auth()->user()->id,
            'rating' => $request->rating,
            'ulasan' => $request->ulasan,
        ]);

        // dd($ul);

        return redirect()->route('ulasan.show', ['dasarBuku' => $ul->id_buku])->with('success', 'Review added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ulasan $ulasan, $bookId)
    {
        // Assuming you already have $book
        $dasarBuku = DasarBuku::where('id_buku', $bookId)->get();
        // dd($dasarBuku);
        // $data = [
        $tentang = Tentang::first();
        $sosmed= Sosmed::all();
        $detailBuku= DetailBuku::where('id_buku', $bookId)->get();
        $totalReviews = Ulasan::where('id_buku', $bookId)->count();

        // Calculate average rating
        $averageRating = Ulasan::where('id_buku', $bookId)->avg('rating');

        // Paginate customer reviews
        $customerReviews = Ulasan::where('id_buku', $bookId)->paginate(10);

        return view('frontend.book-detail.index', [
            'dasarBuku' => $dasarBuku,
            'averageRating' => $averageRating,
            'customerReviews' => $customerReviews,
            'tentang' => $tentang,
            'sosmed' => $sosmed,
            'detailBuku' => $detailBuku,
            'totalReviews' => $totalReviews
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ulasan $ulasan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ulasan $ulasan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ulasan $ulasan)
    {
        //
    }
}
