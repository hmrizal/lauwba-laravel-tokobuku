<!DOCTYPE html>
<html>
@include('frontend.title')

<body>
    {{-- SELAMAT DATANG --}}
    @include('frontend.header')
    {{-- kurang ini alertnya --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('errors'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('errors')->first() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <section class="hero-section bg-gray d-flex align-items-center justify-content-center padding-medium pb-5">
        <div class="hero-content">
            <div class="container">
                <div class="row">
                    <div class="text-center padding-medium no-padding-bottom">
                        <h1>Browse All of Our Books</h1>
                        <div class="breadcrumbs mt-5">
                            <span class="item">You are here:
                                <a href="/"> Home ></a>
                            </span>
                            <span class="item">Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="shopify-grid padding-large">
        <div class="container">
            <div class="row">
                <main class="col-md-9">
                    <div class="filter-shop d-flex flex-wrap justify-content-between">
                        <div class="showing-product">
                            <p>Showing {{ $books->firstItem() }} - {{ $books->lastItem() }} of {{ $books->total() }}
                                results</p>
                        </div>
                        <div class="sort-by">
                            <select id="input-sort" class="form-control" data-filter-sort="" data-filter-order=""
                                onchange="window.location.href=this.options[this.selectedIndex].value;">
                                <option value="">Default sorting</option>
                                <option value="{{ route('books.sort.title', 'asc') }}">Title (A - Z)</option>
                                <option value="{{ route('books.sort.title', 'desc') }}">Title (Z - A)</option>
                                <option value="{{ route('books.sort.price', 'asc') }}">Price (Low-High)</option>
                                <option value="{{ route('books.sort.price', 'desc') }}">Price (High-Low)</option>
                            </select>
                        </div>
                    </div>
                    <div class="row product-content product-store">
                        @foreach ($books as $book)
                            <div class="col-lg-4 col-md-6">
                                <div class="product-card mb-4">
                                    <div class="image-holder">
                                        <img src="{{ Storage::url($book->detailBuku->foto) }}" alt="product-item"
                                            class="img-fluid" style="height: 400px;objec-fit:contain;">
                                        @if (Auth::check())
                                            <form action="{{ route('cart.add', ['bookId' => $book->id_buku]) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-primary" style="width:100%">Add to
                                                    Cart</button>
                                            </form>
                                        @else
                                            <button type="submit" class="btn btn-primary" style="width:100%"><a
                                                    href="{{ route('customer.login') }}">Add to Cart</a></button>
                                        @endif
                                    </div>
                                    <div class="card-detail text-center pt-3 pb-2">
                                        <h5 class="card-title fs-4 m-0" style="height:75px">
                                            <a href="/book-detail/{{ $book->id_buku }}">{{ $book->judul }}</a>
                                        </h5>
                                        <p><a href="/authors/{{ $book->id_penulis }}">{{ $book->penulis->nama }}</a>
                                        </p>
                                        @if ($book->diskon > 0)
                                            <span class="item-price text-primary fs-4">@rupiah(((100 - $book->diskon) / 100) * $book->harga_asli)</span>
                                            <del>@rupiah($book->harga_asli)</del>
                                        @else
                                            <span class="item-price text-primary fs-4">@rupiah($book->harga_asli)</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center mt-5">
                        {{ $books->links('pagination::bootstrap-5') }}
                    </div>
                </main>
                <aside class="col-md-3">
                    <div class="sidebar">
                        <div class="widget-menu">
                            <div class="widget-search-bar">
                                @csrf
                                <form role="search" method="get" action="/books"
                                    class="position-relative d-flex justify-content-between align-items-center border-bottom border-dark py-1">
                                    <input class="search-field" placeholder="Search book title here" type="search" name="search" value="{{request('search')}}">
                                    <button type="submit" class="nav-link text-uppercase me-0">Search</button>

                                </form>
                            </div>
                        </div>
                        <div class="widget-product-categories pt-5">
                            <h5 class="widget-title text-uppercase">Genres</h5>
                            <ul class="product-categories sidebar-list list-unstyled">
                                <li class="cat-item">
                                    <a href="/books">All</a>
                                    {{-- {{dd($hasilCari)}} --}}
                                </li>
                                <li class="cat-item">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            {{-- <h2 class="accordion-header" id="flush-headingOne"> --}}
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                aria-expanded="false" aria-controls="flush-collapseOne">
                                                Fiction
                                            </button>
                                            {{-- </h2> --}}
                                            @foreach ($fiction as $fict)
                                                <div id="flush-collapseOne" class="accordion-collapse collapse"
                                                    aria-labelledby="flush-headingOne"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">
                                                        <ul>
                                                            <li>
                                                                {{-- @foreach ($subgenres as $subgenre) --}}
                                                                <a
                                                                    href="{{ route('books.filter.subgenre', $fict->subgenre) }}">{{ $fict->subgenre }}</a>
                                                                {{-- @endforeach --}}
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="accordion-item">
                                            {{-- <h2 class="accordion-header" id="flush-headingTwo"> --}}
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                                                aria-expanded="false" aria-controls="flush-collapseTwo">
                                                Nonfiction
                                            </button>
                                            {{-- </h2> --}}
                                            @foreach ($nonfiction as $nonfic)
                                                <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                                    aria-labelledby="flush-headingTwo"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">
                                                        <ul>
                                                            <li>
                                                                <a
                                                                    href="{{ route('books.filter.subgenre', $nonfic->subgenre) }}">{{ $nonfic->subgenre }}</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="widget-price-filter pt-3">
                            <h5 class="widget-title text-uppercase">Filter By Price</h5>
                            <ul class="product-tags sidebar-list list-unstyled">
                                <li class="tags-item">
                                    <a href="{{ route('books.filter.price', '0-100000') }}">Less than
                                        @rupiah(100000)</a>
                                </li>
                                <li class="tags-item">
                                    <a href="{{ route('books.filter.price', '100000-200000') }}">@rupiah(100000) -
                                        @rupiah(200000)</a>
                                </li>
                                <li class="tags-item">
                                    <a href="{{ route('books.filter.price', '200000-300000') }}">@rupiah(200000) -
                                        @rupiah(300000)</a>
                                </li>
                                <li class="tags-item">
                                    <a href="{{ route('books.filter.price', '300000-400000') }}">@rupiah(300000) -
                                        @rupiah(400000)</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
    @include('frontend.footer')
</body>

</html>
