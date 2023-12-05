<!DOCTYPE html>
<html>
@include('frontend.title')

<body>
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
    <section id="billboard" class="bg-gray padding-large">
        <div class="swiper main-swiper">
            <div class="swiper-wrapper">
                @foreach ($detailBuku->sortByDesc('tanggal_rilis')->take(3) as $detail)
                    <div class="swiper-slide">
                        <div class="container">
                            <div class="row">
                                <div class="offset-md-1 col-md-5">
                                    <img src="{{ Storage::url($detail->foto) }}" alt="product-img"
                                        class="img-fluid mb-3">
                                </div>
                                <div class="col-md-6 d-flex align-items-center">
                                    <div class="banner-content">
                                        <h2>{{ $detail->dasarBuku->judul }}</h2>
                                        <p class="fs-5">{{ strtok($detail->dasarBuku->sinopsis, '.') }}</p>
                                        <a href="/book-detail/{{ $detail->id_buku }}" class="btn">Shop now →</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="main-slider-pagination text-center mt-3"></div>
    </section>
    <section id="company-services" class="padding-medium">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 pb-3">
                    <div class="icon-box text-center">
                        <span class="icon-box-icon d-inline-block p-4 border border-accent rounded-circle mb-4">
                            <svg width="30" height="30" class="cart-outline text-primary">
                                <use xlink:href="#cart-outline">
                            </svg>
                        </span>
                        <div class="icon-box-content">
                            <h4 class="card-title">Fast delivery</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 pb-3">
                    <div class="icon-box text-center">
                        <div class="icon-box-icon d-inline-block p-4 border border-accent rounded-circle mb-4">
                            <svg width="30" height="30" class="quality text-primary">
                                <use xlink:href="#quality">
                            </svg>
                        </div>
                        <div class="icon-box-content">
                            <h4 class="card-title">Quality guarantee</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 pb-3">
                    <div class="icon-box text-center">
                        <div class="icon-box-icon d-inline-block p-4 border border-accent rounded-circle mb-4">
                            <svg width="30" height="30" class="price-tag text-primary">
                                <use xlink:href="#price-tag">
                            </svg>
                        </div>
                        <div class="icon-box-content">
                            <h4 class="card-title">Daily offers</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 pb-3">
                    <div class="icon-box text-center">
                        <div class="icon-box-icon d-inline-block p-4 border border-accent rounded-circle mb-4">
                            <svg width="30" height="30" class="shield-plus text-primary">
                                <use xlink:href="#shield-plus">
                            </svg>
                        </div>
                        <div class="icon-box-content">
                            <h4 class="card-title">100% secure payment</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="products" class="product-store position-relative padding-medium pb-0">
        <div class="container display-header d-flex flex-wrap justify-content-between pb-4">
            <h3 class="mt-3">Best selling Items</h3>
            <div class="btn-right d-flex flex-wrap align-items-center">
                <a href="/books" class="btn me-5">View all items →</a>
                <div class="swiper-buttons">
                    <button class="swiper-prev product-carousel-prev me-2">
                        <svg width="41" height="41">
                            <use xlink:href="#angle-left"></use>
                        </svg>
                    </button>
                    <button class="swiper-next product-carousel-next">
                        <svg width="41" height="41">
                            <use xlink:href="#angle-right"></use>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div class="swiper product-swiper">
            <div class="swiper-wrapper">
                @foreach ($dasarBuku->sortBy('stok')->take(10) as $dasar)
                    {{-- @foreach ($dasarBuku as $dasar) --}}
                    <div class="swiper-slide">
                        {{-- <style>
                            .product-card .cart-concern svg {
                                width: 10px;
                                height: 16px;
                                fill: var(--light-color);
                                margin-left: 9px;
                            }
                        </style> --}}
                        <div class="product-card">
                            <div class="image-holder">
                                <img src="{{ Storage::url($dasar->detailBuku->foto) }}" alt="product-item"
                                    class="img-fluid" style="height: 400px;objec-fit:cover;">
                                @if (Auth::check())
                                    <form action="{{ route('cart.add', ['bookId' => $dasar->id_buku]) }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary" style="width:100%">Add to
                                            Cart</button>
                                    </form>
                                @else
                                    <button type="submit" class="btn btn-primary" style="width:100%"><a
                                            href="{{ route('customer.login') }}">Add to Cart</a></button>
                                @endif
                                {{-- <button type="button" class="add-to-cart" style="width:100%">Add to Cart</button> --}}
                            </div>
                            <div class="card-detail text-center pt-3 pb-2">
                                <h5 class="card-title fs-4 m-0" style="height:75px">
                                    <a href="/book-detail/{{ $dasar->id_buku }}">{{ $dasar->judul }}</a>
                                </h5>
                                <p><a href="/authors/{{ $dasar->id_penulis }}">{{ $dasar->penulis->nama }}</a></p>
                                <p>{{ $dasar->stok }} in stock</p>
                                @if ($dasar->diskon > 0)
                                    <span class="item-price text-primary fs-4">@rupiah(((100 - $dasar->diskon) / 100) * $dasar->harga_asli)</span>
                                    <del>@rupiah($dasar->harga_asli)</del>
                                @else
                                    <span class="item-price text-primary fs-4">@rupiah($dasar->harga_asli)</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section id="about" class="padding-large">
        <div class="container">
            <div class="row position-relative">
                <div class="col-lg-8">
                    <div class="image-holder">
                        <img src="{{ asset('front-template') }}/images/single-image3.jpg" alt="single"
                            class="single-image img-fluid">
                    </div>
                </div>
                <div class="about-content bg-gray col-lg-4 m-auto top-0 end-0 bottom-0">
                    <h3 class="py-3">Who are we</h3>
                    <p>{{ strtok($tentang->deskripsi, '.') }}</p>
                    <a href="/about" class="btn">About us →</a>
                </div>
            </div>
        </div>
    </section>
    <section id="products" class="product-store padding-xlarge pt-0 position-relative">
        <div class="container display-header d-flex flex-wrap justify-content-between pb-4">
            <h3 class="mt-3">Recommended</h3>
            <div class="btn-right d-flex flex-wrap align-items-center">
                <a href="/books" class="btn me-5">View all items →</a>
                <div class="swiper-buttons">
                    <button class="swiper-prev product-carousel-prev me-2">
                        <svg width="41" height="41">
                            <use xlink:href="#angle-left"></use>
                        </svg>
                    </button>
                    <button class="swiper-next product-carousel-next">
                        <svg width="41" height="41">
                            <use xlink:href="#angle-right"></use>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div class="swiper product-swiper">
            <div class="swiper-wrapper">
                {{-- {{dd($rekom)}} --}}
                @foreach ($rekom as $rek)
                    {{-- {{dd($rek)}} --}}
                    <div class="swiper-slide">
                        <div class="product-card">
                            <div class="image-holder">
                                <img src="{{ Storage::url($rek->foto) }}" alt="product-item" class="img-fluid"
                                    style="height: 400px;objec-fit:cover;">
                                @if (Auth::check())
                                    <form action="{{ route('cart.add', ['bookId' => $rek->id_buku]) }}"
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
                                    <a href="/book-detail/{{ $rek->id_buku }}">{{ $rek->judul }}</a>
                                </h5>
                                <p><a href="/authors/{{ $rek->id_penulis }}">{{ $rek->nama }}</a></p>
                                <div class="rating mt-3">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i
                                            class="rating-star fa fa-star {{ $i <= $rek->average_rating ? 'active' : '' }}"></i>
                                    @endfor
                                </div>
                                <!-- CSS for Star Rating -->
                                <style>
                                    .rating {
                                        color: gray;
                                        /* Set color to gold/yellow */
                                    }

                                    .rating-star {
                                        font-size: 20px;
                                        margin-right: 5px;
                                    }

                                    .rating .active {
                                        color: gold;
                                        /* Set color to gold/yellow for active stars */
                                    }
                                </style>
                                <p class="rating-count lh-normal">{{ number_format($rek->average_rating, 1) }} from
                                    {{ $rek->num_reviewers }} customers</p>
                                @if ($rek->diskon > 0)
                                    <span class="item-price text-primary fs-4"><b>@rupiah(((100 - $rek->diskon) / 100) * $rek->harga_asli)</b></span>
                                    <del>@rupiah($rek->harga_asli)</del>
                                @else
                                    <p class="item-price text-primary fs-4"><b>@rupiah($rek->harga_asli)</b></p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section id="testimonials" class="position-relative padding-large pt-0">
        <div class="container">
            <div class="row">
                <div class="offset-md-2 col-md-8">
                    <h3 class="text-center mb-5">What our customers says</h3>
                    <div class="review-content position-relative">
                        <div class="swiper testimonial-swiper">
                            <div class="swiper-wrapper">
                                @foreach ($ulasanToko as $ulto)
                                    <div class="swiper-slide text-center d-flex justify-content-center">
                                        <div class="review-item">
                                            <blockquote class="fs-1 fw-light">“{{ $ulto->ulasan }}”</blockquote>
                                            <div class="author-detail">
                                                <div class="name fw-bold text-uppercase pt-2">{{ $ulto->users->name }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="swiper-buttons text-center mt-5">
                        <button class="swiper-prev testimonial-arrow-prev me-2">
                            <svg width="41" height="41">
                                <use xlink:href="#arrow-left"></use>
                            </svg>
                        </button>
                        <span>|</span>
                        <button class="swiper-next testimonial-arrow-next ms-2">
                            <svg width="41" height="41">
                                <use xlink:href="#arrow-right"></use>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="products" class="product-store padding-xlarge pt-0 position-relative">
        <div class="container display-header d-flex flex-wrap justify-content-between pb-4">
            <h3 class="mt-3">Best Offer</h3>
            <div class="btn-right d-flex flex-wrap align-items-center">
                <a href="/books" class="btn me-5">View all items →</a>
                <div class="swiper-buttons">
                    <button class="swiper-prev product-carousel-prev2 me-2">
                        <svg width="41" height="41">
                            <use xlink:href="#angle-left"></use>
                        </svg>
                    </button>
                    <button class="swiper-next product-carousel-next2">
                        <svg width="41" height="41">
                            <use xlink:href="#angle-right"></use>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div class="swiper product-swiper2">
            <div class="swiper-wrapper">
                @foreach ($dasarBuku->where('diskon', '>', 0)->take(10) as $offer)
                    <div class="swiper-slide">
                        <div class="product-card">
                            <div class="image-holder">
                                <img src="{{ Storage::url($offer->detailBuku->foto) }}" alt="product-item"
                                    class="img-fluid" style="height: 400px;objec-fit:cover;">
                                @if (Auth::check())
                                    <form action="{{ route('cart.add', ['bookId' => $offer->id_buku]) }}"
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
                                    <a href="/book-detail/{{ $offer->id_buku }}">{{ $offer->judul }}</a>
                                </h5>
                                <p><a href="/authors/{{ $offer->id_penulis }}">{{ $offer->penulis->nama }}</a></p>
                                {{-- <p>{{ $offer->stok }} in stock</p> --}}
                                <span class="item-price text-primary fs-4">@rupiah(((100 - $offer->diskon) / 100) * $offer->harga_asli)</span>
                                <del>@rupiah($offer->harga_asli)</del>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <hr>
    @include('frontend.footer')
</body>

</html>
