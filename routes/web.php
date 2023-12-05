<?php

use App\Http\Controllers\GenreController;
use App\Http\Controllers\PenulisController;
use App\Http\Controllers\DasarBukuController;
use App\Http\Controllers\DetailBukuController;
use App\Http\Controllers\MailboxController;
use App\Http\Controllers\TentangController;
use App\Http\Controllers\SosmedController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LanggananController;
use App\Http\Controllers\UlasanTokoController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['guest'])->group(function () {
    Route::get('/backend/login', [LoginController::class, 'users'])->name('login');
    Route::get('/login', [LoginController::class, 'show'])->name('customer.login');
    Route::post('/backend/login', [LoginController::class, 'authenticate']);
    Route::post('/login', [LoginController::class, 'authenticate']);
});


Route::post('/backend/mailbox/store', [MailboxController::class, 'store']);
Route::post('/backend/langganan/store', [LanggananController::class, 'store']);
Route::get('/backend/welcome', [LoginController::class, 'welcome']);

Route::middleware(['auth'])->group(function () {

    Route::get('/logout', [LoginController::class, 'logout']);

    Route::middleware(['admin'])->group(function () {

        Route::get('/backend', function () {
            return view('backend.index');
        });

        Route::get('/backend/dashboard', [DashboardController::class, 'index']);

        // route utk class genre
        Route::get('/backend/genre', [GenreController::class, 'index']);
        Route::get('/backend/genre/create', [GenreController::class, 'create']);
        Route::post('/backend/genre/store', [GenreController::class, 'store']);
        Route::get('/backend/genre/edit/{genre}', [GenreController::class, 'edit']);
        Route::post('/backend/genre/update/{genre}', [GenreController::class, 'update']);
        Route::get('/backend/genre/delete/{genre}', [GenreController::class, 'destroy']);

        Route::get('/backend/penulis', [PenulisController::class, 'index']);
        Route::get('/backend/penulis/create', [PenulisController::class, 'create']);
        Route::post('/backend/penulis/store', [PenulisController::class, 'store']);
        Route::get('/backend/penulis/edit/{penulis}', [PenulisController::class, 'edit']);
        Route::post('/backend/penulis/update/{penulis}', [PenulisController::class, 'update']);
        Route::get('/backend/penulis/delete/{penulis}', [PenulisController::class, 'destroy']);

        Route::get('/backend/umum', [DasarBukuController::class, 'index']);
        Route::get('/backend/umum/create', [DasarBukuController::class, 'create']);
        Route::post('/backend/umum/store', [DasarBukuController::class, 'store']);
        Route::get('/backend/umum/edit/{dasarBuku}', [DasarBukuController::class, 'edit']);
        Route::post('/backend/umum/update/{dasarBuku}', [DasarBukuController::class, 'update']);
        Route::get('/backend/umum/delete/{dasarBuku}', [DasarBukuController::class, 'destroy']);

        Route::get('/backend/rinci', [DetailBukuController::class, 'index']);
        Route::get('/backend/rinci/create', [DetailBukuController::class, 'create']);
        Route::post('/backend/rinci/store', [DetailBukuController::class, 'store']);
        Route::get('/backend/rinci/edit/{detailBuku}', [DetailBukuController::class, 'edit']);
        Route::post('/backend/rinci/update/{detailBuku}', [DetailBukuController::class, 'update']);
        Route::get('/backend/rinci/delete/{detailBuku}', [DetailBukuController::class, 'destroy']);

        Route::get('/backend/mailbox', [MailboxController::class, 'index']);

        Route::get('/backend/mailbox/delete/{mailbox}', [MailboxController::class, 'destroy']);

        Route::get('/backend/langganan', [LanggananController::class, 'index']);

        Route::get('/backend/langganan/delete/{langganan}', [LanggananController::class, 'destroy']);

        Route::get('/backend/ulasantoko', [UlasanTokoController::class, 'index']);
        Route::post('/backend/ulasantoko/store', [UlasanTokoController::class, 'store']);
        Route::get('/backend/ulasantoko/delete/{ulasantoko}', [UlasanTokoController::class, 'destroy']);

        Route::get('/backend/tentang', [TentangController::class, 'index']);
        Route::get('/backend/tentang/create', [TentangController::class, 'create']);
        Route::post('/backend/tentang/store', [TentangController::class, 'store']);
        Route::get('/backend/tentang/edit/{tentang}', [TentangController::class, 'edit']);
        Route::post('/backend/tentang/update/{tentang}', [TentangController::class, 'update']);

        Route::get('/backend/sosmed', [SosmedController::class, 'index']);
        Route::get('/backend/sosmed/create', [SosmedController::class, 'create']);
        Route::post('/backend/sosmed/store', [SosmedController::class, 'store']);
        Route::get('/backend/sosmed/edit/{sosmed}', [SosmedController::class, 'edit']);
        Route::post('/backend/sosmed/update/{sosmed}', [SosmedController::class, 'update']);
        Route::get('/backend/sosmed/delete/{sosmed}', [SosmedController::class, 'destroy']);

        Route::get('/backend/customer', [CustomerController::class, 'index']);
        Route::post('/backend/customer/store', [CustomerController::class, 'store']);
        Route::get('/backend/customer/delete/{customer}', [CustomerController::class, 'destroy']);

        Route::get('/backend/nota', [NotaController::class, 'index']);
    });
});

Route::get('/', [IndexController::class, 'index']);

Route::get('/about', [AboutController::class, 'index']);

Route::get('/books', [BooksController::class, 'index']);
Route::get('/books/search', [BooksController::class, 'search'])->name('search');
Route::get('/books/filter/subgenre/{subgenre}', [BooksController::class, 'filterBySubgenre'])->name('books.filter.subgenre');
Route::get('/books/filter/price/{range}', [BooksController::class, 'filterByPrice'])->name('books.filter.price');
// Route::get('/books/filter/price/{range}', [BooksController::class, 'destroy'])->name('books.filter.price');
Route::get('/books/sort/title/{order}', [BooksController::class, 'sortByTitle'])->name('books.sort.title');
Route::get('/books/sort/price/{order}', [BooksController::class, 'sortByPrice'])->name('books.sort.price');


Route::post('/customer/store', [LoginController::class, 'store']);
// Route::get('/login', [CustomerController::class, 'users'])->name('login');
// Route::get('/', [CustomerController::class, 'welcome']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/contact', [ContactController::class, 'index']);

Route::get('/ulasantoko/create', [UlasanTokoController::class, 'create']);

Route::get('/cart', [CartController::class, 'showCart']);
Route::post('/cart/add/{bookId}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/count', [CartController::class, 'getCartCount'])->name('cart.count');
Route::put('/cart/update', [CartController::class, 'updateJumlah']);
Route::delete('/cart/remove/{cart}', [CartController::class, 'hapusItem']);
Route::get('/cart/nota', [CartController::class, 'createNota']);

Route::post('/nota/store', [NotaController::class, 'store'])->name('nota');
Route::get('/nota/{nota}', [NotaController::class, 'show']);

Route::get('/authors/{penulis}', [AuthorsController::class, 'index']);
Route::get('/book-detail/{dasarBuku}', [DetailController::class, 'index']);
Route::get('/book-detail/ulasan/{dasarBuku}', [UlasanController::class, 'create'])->name('book.ulasan.create');
Route::post('/book-detail/ulasan/store/{dasarBuku}', [UlasanController::class, 'store'])->name('ulasan.store');
Route::get('/book-detail/ulasan/show/{dasarBuku}', [UlasanController::class, 'show'])->name('ulasan.show');
