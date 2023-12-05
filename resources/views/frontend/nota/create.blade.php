<!DOCTYPE html>
<html>
@include('frontend.title')

<body>
    @include('frontend.header')
    <section class="hero-section bg-gray d-flex align-items-center justify-content-center padding-medium pb-5">
        <div class="hero-content">
            <div class="container">
                <div class="row">
                    <div class="text-center padding-medium no-padding-bottom">
                        <h1>Checkout</h1>
                        <div class="breadcrumbs">
                            <span class="item">
                                <a href="index.html">Home ></a>
                            </span>
                            <span class="item">Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="shopify-cart checkout-wrap padding-large">
        <div class="container">
            <div class="form-group">
                <div class="row d-flex flex-wrap">
                    <div class="col-lg-6">
                        <h3 class="pb-4">Billing Details</h3>
                        <form class="billing-details" action="/nota/store" method="POST" id="form">
                            @csrf
                            <div class="py-3">
                                <label for="fname">Name</label>
                                <input type="text" id="fname" name="name" class="w-100"
                                    value="{{ Auth::user()->name }}" disabled readonly>
                            </div>
                            <div class="py-3">
                                <label for="email">Email address *</label>
                                <input type="text" id="email" name="email" class="w-100"
                                    value="{{ Auth::user()->email }}" disabled readonly>
                            </div>
                            <div class="py-3">
                                <label for="alamat">Street Address*</label>
                                <textarea type="text" id="alamat" name="alamat" placeholder="Input your shipping address" class="w-100"
                                    cols="50" rows="5"></textarea>
                            </div>
                            <div class="py-3">
                                <label for="kode_pos">Zip Code *</label>
                                <input type="text" id="kode_pos" name="kode_pos" class="w-100">
                            </div>
                            <div class="py-3">
                                <label for="phone">Phone *</label>
                                <input type="text" id="phone" name="phone" class="w-100">
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6">
                        <div class="your-order mt-5">
                            <h3 class="pb-4">Cart Totals</h3>
                            <div class="total-price">
                                <table cellspacing="0" class="table">
                                    <thead>
                                        <tr
                                            class="subtotal border-top border-bottom border-dark pt-2 pb-2 text-uppercase">
                                            <th scope="col">Book</th>
                                            <th scope="col">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cartItems as $item)
                                            <tr
                                                class="subtotal border-top border-bottom border-dark pt-2 pb-2">
                                                <td>{{ $item->dasarBuku->judul }}</td>
                                                @if ($item->dasarBuku->diskon > 0)
                                                    <td>
                                                        <span class="price-amount amount text-primary ps-5">
                                                            <bdi>
                                                                <span class="price-currency-symbol">
                                                                    @rupiah($item->jumlah * ((100 - $item->dasarBuku->diskon) / 100) * $item->dasarBuku->harga_asli)</span></bdi>
                                                        </span>
                                                    </td>
                                                @else
                                                    <td> <span class="price-amount amount text-primary ps-5">
                                                            <bdi>
                                                                <span
                                                                    class="price-currency-symbol">@rupiah($item->jumlah * $item->dasarBuku->harga_asli)</span></bdi>
                                                        </span></td>
                                                @endif
                                            </tr>
                                        @endforeach
                                        <tr
                                            class="subtotal border-top border-bottom border-dark pt-2 pb-2 text-uppercase">
                                            <th class="fw-light">Subtotal</th>
                                            <td data-title="Subtotal">
                                                <span class="price-amount amount text-primary ps-5">
                                                    <bdi>
                                                        <span
                                                            class="price-currency-symbol">@rupiah($subtotal)</span></bdi>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr
                                            class="subtotal border-top border-bottom border-dark pt-2 pb-2 text-uppercase">
                                            <th class="fw-light">Tax (2%)</th>
                                            <td data-title="Subtotal">
                                                <span class="price-amount amount text-primary ps-5">
                                                    <bdi>
                                                        <span
                                                            class="price-currency-symbol">@rupiah($tax)</span></bdi>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr
                                            class="subtotal border-top border-bottom border-dark pt-2 pb-2 text-uppercase">
                                            <th class="fw-light">Shipping</th>
                                            <td data-title="Subtotal">
                                                <span class="price-amount amount text-primary ps-5">
                                                    <bdi>
                                                        <span
                                                            class="price-currency-symbol">@rupiah($shipping)</span></bdi>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="order-total border-bottom border-dark pt-2 pb-2 text-uppercase">
                                            <th>Total</th>
                                            <td data-title="Total" name="total_harga">
                                                <span class="price-amount amount text-primary ps-5">
                                                    <bdi>
                                                        <span
                                                            class="price-currency-symbol">@rupiah($total)</span></bdi>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                {{-- <div class="list-group mt-5 mb-3">
                                    <label class="list-group-item p-0 bg-transparent d-flex gap-2 border-0">
                                        <input class="form-check-input p-0 flex-shrink-0" type="radio"
                                            name="listGroupRadios" id="listGroupRadios1" value="" checked>
                                        <span>
                                            <div class="fw-300 text-uppercase">Direct bank transfer</div>
                                            <p class="d-block">Make your payment directly into our bank account. Please
                                                use your Order ID. Your order will shipped after funds have cleared in
                                                our account.</p>
                                        </span>
                                    </label>
                                    <label class="list-group-item p-0 bg-transparent d-flex gap-2 border-0">
                                        <input class="form-check-input p-0 flex-shrink-0" type="radio"
                                            name="listGroupRadios" id="listGroupRadios2" value="">
                                        <span>
                                            <div class="fw-300 text-uppercase">Check payments</div>
                                            <p class="d-block">Please send a check to Store Name, Store Street, Store
                                                Town, Store State / County, Store Postcode.</p>
                                        </span>
                                    </label>
                                    <label class="list-group-item p-0 bg-transparent d-flex gap-2 border-0">
                                        <input class="form-check-input p-0 flex-shrink-0" type="radio"
                                            name="listGroupRadios" id="listGroupRadios3" value="">
                                        <span>
                                            <div class="fw-300 text-uppercase">Cash on delivery</div>
                                            <p class="d-block">Pay with cash upon delivery.</p>
                                        </span>
                                    </label>
                                    <label class="list-group-item p-0 bg-transparent d-flex gap-2 border-0">
                                        <input class="form-check-input p-0 flex-shrink-0" type="radio"
                                            name="listGroupRadios" id="listGroupRadios3" value="">
                                        <span>
                                            <div class="fw-300 text-uppercase">Paypal</div>
                                            <p class="d-block">Pay via PayPal; you can pay with your credit card if you
                                                don’t have a PayPal account.</p>
                                        </span>
                                    </label>
                                </div> --}}
                                <button name="submit" class="btn btn-dark w-100" onclick="$('#form').submit()" >Place an
                                    order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('frontend.footer')
</body>

</html>
