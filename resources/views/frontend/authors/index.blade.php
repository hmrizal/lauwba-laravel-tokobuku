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
    <section id="author-grid" class="padding-medium">
        <div class="container">
            <div class="row">
                @foreach ($penulis as $p)
                    <div class="col-md-5">
                        <img src="{{ Storage::url($p->foto) }}" alt="author-image" class="img-fluid">
                    </div>
                    <div class="col-md-7 d-flex align-items-center">
                        <div class="about-author mt-3">
                            {{-- <div class="country">USA</div> --}}
                            <h3 class="author-name">{{ $p->nama }}</h3>
                            {{-- <blockquote>"Sit suscipit tortor turpis sed fringilla lectus facilisis amet. Ipsum, amet dolor curabitur non aliquet orci urna volutpat."</blockquote> --}}
                            <p>{{ $p->biografi }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section id="products" class="product-store position-relative padding">
        <div class="container display-header d-flex flex-wrap justify-content-between pb-4">
            <h3 class="mt-3">Books by {{ $p->nama }}</h3>
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
                @foreach ($detailBuku as $detail)
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
                                <img src="{{ Storage::url($detail->foto) }}" alt="product-item" class="img-fluid"
                                    style="height: 400px;objec-fit:cover;">
                                @if (Auth::check())
                                    <form action="{{ route('cart.add', ['bookId' => $detail->dasarBuku->id_buku]) }}"
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
                                <h5 class="card-title fs-4 m-0">
                                    <a href="/book-detail/{{ $detail->id_buku }}">{{ $detail->dasarBuku->judul }}</a>
                                </h5>
                                <p><a
                                        href="/authors/{{ $detail->dasarBuku->id_penulis }}">{{ $detail->dasarBuku->penulis->nama }}</a>
                                </p>
                                <span class="item-price text-primary fs-4">@rupiah($detail->dasarBuku->harga_asli)</span>
                                {{-- <div class="cart-button mt-1">
                  <a href="#" class="btn">Add to cart</a>
                </div> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @include('frontend.footer')
</body>

</html>
