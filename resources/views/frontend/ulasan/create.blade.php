<!DOCTYPE html>
<html>
@include('frontend.title')

<body>
    @include('frontend.header')
    <section class="single-product padding-medium">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    @foreach ($detailBuku as $detail)
                        <img src="{{ Storage::url($detail->foto) }}" alt="author-image" class="img-fluid">
                    @endforeach
                </div>
                <div class="col-lg-7">
                    <div class="product-info mt-3">
                        @foreach ($dasarBuku as $dasar)
                            <div class="element-header">
                                <div class="author"><a
                                        href="/authors/{{ $dasar->id_penulis }}">{{ $dasar->penulis->nama }}</a></div>
                                <h3 class="product-title">{{ $dasar->judul }}</h3>
                                <div class="meta-product">
                                    <div class="meta-item d-flex mb-1">
                                        <span class="text-uppercase me-2">Genre:</span>
                                        <ul class="select-list list-unstyled d-flex mb-0">
                                            <li data-value="{{ $dasar->genre->subgenre }}" class="select-item">
                                                <a
                                                    href="{{ route('books.filter.subgenre', $dasar->genre->subgenre) }}">{{ $dasar->genre->subgenre }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="rating mt-3">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i
                                            class="rating-star fa fa-star{{ $i <= $averageRating ? ' active' : '' }}"></i>
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

                                    .rating-star.active {
                                        color: gold;
                                        /* Set color to gold/yellow for active stars */
                                    }
                                </style>
                                <span class="rating-count lh-normal">{{ round($averageRating, 1) }} from
                                    {{ $totalReviews }} customers</span>
                            </div>
                    </div>
                    @endforeach
                    <div class="product-price my-3">
                        @if ($dasar->diskon > 0)
                            <span class="fs-1 text-primary">@rupiah(((100 - $dasar->diskon) / 100) * $dasar->harga_asli)</span>
                            <del>@rupiah($dasar->harga_asli)</del>
                        @else
                            <span class="fs-1 text-primary">@rupiah($dasar->harga_asli)</span>
                        @endif
                    </div>
                    @foreach ($detailBuku as $detail)
                        <ul>
                            <li>Publisher: {{ $detail->penerbit }}</li>
                            <li>Release Date: {{ $detail->tanggal_rilis }}</li>
                            <li>Length: {{ $detail->halaman }} pages</li>
                            <li>Dimensions: {{ $detail->ukuran }}</li>
                            <li>Weight: {{ $detail->berat }} grams</li>
                        </ul>
                    @endforeach
                    <hr>
                    <div class="cart-wrap">
                        <div class="product-quantity my-3">
                            <div class="item-title">
                                <b>{{ $dasar->stok }} in stock</b>
                            </div>
                        </div>
                        <div class="action-buttons my-4 d-flex flex-wrap">
                            @if (Auth::check())
                                <a href="{{ route('book.ulasan.create', $dasar->id_buku) }}"
                                    class="btn btn-dark me-2 mb-1">Rate this book</a>
                            @else
                                <a href="{{ route('customer.login') }}" class="btn btn-dark me-2 mb-1">Rate this
                                    book</a>
                            @endif
                            @if (Auth::check())
                                <form action="{{ route('cart.add', ['bookId' => $dasar->id_buku]) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-dark" type="submit">Add to cart</button>
                                </form>
                            @else
                                <button class="btn btn-dark" type="submit"><a href="{{ route('customer.login') }}">Add
                                        to Cart</a></button>
                            @endif
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
        </div>
    </section>
    <section class="product-tabs padding-large">
        <div class="container">
            <div class="row">
                <div class="tabs-listing">
                    <nav>
                        <div class="nav nav-tabs d-flex justify-content-center py-3" id="nav-tab" role="tablist">
                            <button class="nav-link fw-light text-uppercase active" id="nav-home-tab"
                                data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab"
                                aria-controls="nav-home" aria-selected="true">Synopsis</button>
                            <button class="nav-link fw-light text-uppercase" id="nav-shipping-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-shipping" type="button" role="tab"
                                aria-controls="nav-shipping" aria-selected="false">Reviews</button>
                            @include('frontend.ulasan.tab')
                        </div>
                    </nav>
                    <div class="bg-gray tab-content" id="nav-tabContent">
                        <div class="tab-pane fade active show" id="nav-home" role="tabpanel"
                            aria-labelledby="nav-home-tab">
                            <p>{{ $dasar->sinopsis }}</p>
                        </div>
                        <div class="tab-pane fade  show" id="nav-shipping" role="tabpanel" aria-labelledby="nav-shipping-tab">
                            @if (sizeof($customerReviews) <= 0)
                                <span>No reviews yet</span>
                            @else
                                <div class="review-box review-style d-flex flex-wrap justify-content-between">
                                    <div class="review-item d-flex">
                                        <!-- Display Customer Reviews -->
                                        <div class="row">
                                            <div class="col-12">
                                                @foreach ($customerReviews as $review)
                                                <div class="review-content pt-1 pb-3">
                                                    <span>
                                                        <div class="rating">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <i
                                                                class="rating-star fa fa-star{{ $i <= $review->rating ? ' active' : '' }}"></i>
                                                        @endfor
                                                        </div>
                                                        ({{ $review->rating }} star)
                                                    </span>
                                                    <div class="review-header">
                                                        <span class="author-name">{{ $review->users->name }}</span>
                                                        <span class="review-date">-
                                                            {{ $review->created_at->format('d/m/Y') }}</span>
                                                    </div>
                                                    <div class="card opacity-50" style="width:1000px; background-color: rgb(0 0 0 / 0%)">
                                                        <p><strong>{{ $review->ulasan }}</strong></p>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- Display Pagination Links -->
                                {{ $customerReviews->links() }}
                            @endif
                        </div>
                        <div class="tab-pane fade " id="nav-review" role="tabpanel" aria-labelledby="nav-review-tab">
                            @include('frontend.ulasan.form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- <section id="products" class="product-store padding-xlarge">
        <div class="container">
            <div class="display-header d-flex flex-wrap justify-content-between align-items-center pb-4">
                <h3 class="mt-3">Related Products</h3>
                <a href="shop.html" class="btn">View all items →</a>
            </div>
            <div class="row">
                <div class="col-md-3 product-card mb-3">
                    <div class="image-holder">
                        <img src="images/product-item1.jpg" alt="product-item" class="img-fluid">
                    </div>
                    <div class="card-detail text-center pt-3 pb-2">
                        <h5 class="card-title fs-4 text-uppercase m-0">
                            <a href="single-product.html">Matt Black</a>
                        </h5>
                        <span class="item-price text-primary fs-4">$870</span>
                        <div class="cart-button mt-1">
                            <a href="#" class="btn">Add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 product-card mb-3">
                    <div class="image-holder">
                        <img src="images/product-item2.jpg" alt="product-item" class="img-fluid">
                    </div>
                    <div class="card-detail text-center pt-3 pb-2">
                        <h5 class="card-title fs-4 text-uppercase m-0">
                            <a href="single-product.html">Matt Black</a>
                        </h5>
                        <span class="item-price text-primary fs-4">$870</span>
                        <div class="cart-button mt-1">
                            <a href="#" class="btn">Add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 product-card mb-3">
                    <div class="image-holder">
                        <img src="images/product-item3.jpg" alt="product-item" class="img-fluid">
                    </div>
                    <div class="card-detail text-center pt-3 pb-2">
                        <h5 class="card-title fs-4 text-uppercase m-0">
                            <a href="single-product.html">Matt Black</a>
                        </h5>
                        <span class="item-price text-primary fs-4">$870</span>
                        <div class="cart-button mt-1">
                            <a href="#" class="btn">Add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 product-card mb-3">
                    <div class="image-holder">
                        <img src="images/product-item4.jpg" alt="product-item" class="img-fluid">
                    </div>
                    <div class="card-detail text-center pt-3 pb-2">
                        <h5 class="card-title fs-4 text-uppercase m-0">
                            <a href="single-product.html">Matt Black</a>
                        </h5>
                        <span class="item-price text-primary fs-4">$870</span>
                        <div class="cart-button mt-1">
                            <a href="#" class="btn">Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    @include('frontend.footer')
</body>

</html>
