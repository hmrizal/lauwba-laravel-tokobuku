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
                        <h1>Review Your Cart</h1>
                        <span>Click "Update Cart" to save your latest cart update</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="shopify-cart padding-large">
        <div class="container">
            <div class="row">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="text-uppercase">
                            <tr>
                                <th scope="col" class="fw-light">Books</th>
                                <th scope="col" class="fw-light">Quantity</th>
                                <th scope="col" class="fw-light">Price</th>
                                <th scope="col" class="fw-light"></th>
                            </tr>
                        </thead>
                        <tbody class="border-top border-gray">
                            @foreach ($cartItems as $item)
                                <tr class="border-bottom border-gray" id="cart-item-{{ $item->id_cart }}">
                                    <td class="align-middle border-0" scope="row">
                                        <div class="cart-product-detail d-flex align-items-center">
                                            <div class="card-image">
                                                <img src="{{ Storage::url($item->dasarBuku->detailBuku->foto) }}"
                                                    alt="cloth" class="img-fluid" style="max-width: 80px">
                                            </div>
                                            <div class="card-detail ps-3">
                                                <h5 class="card-title fs-4 text-uppercase">
                                                    <a
                                                        href="/book-detail/{{ $item->id_buku }}">{{ $item->dasarBuku->judul }}</a>
                                                </h5>
                                                @if ($item->dasarBuku->diskon > 0)
                                                    <span class="item-price text-primary fs-4">@rupiah(((100 - $item->dasarBuku->diskon) / 100) * $item->dasarBuku->harga_asli)</span>
                                                @else
                                                    <span class="item-price text-primary fs-4">@rupiah($item->dasarBuku->harga_asli)</span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle border-0">
                                        <div class="input-group product-qty" style="max-width: 150px;">
                                            <span class="input-group-btn">
                                                <button
                                                    onclick="$('#quantity-{{ $item->id_cart }}').val() > 1 ? updateCartItem({{ $item->id_cart }}, 'decrement') : null"
                                                    width="40" height="40">-</button>
                                            </span>
                                            <input min="1" type="text" id="quantity-{{ $item->id_cart }}"
                                                name="jumlah" class="form-control input-number text-center" readonly
                                                value="{{ $item->jumlah }}">
                                            <span class="input-group-btn">
                                                <button onclick="updateCartItem({{ $item->id_cart }}, 'increment')"
                                                    width="40" height="40">+</button>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="d-none">
                                        @if ($item->dasarBuku->diskon > 0)
                                            <span
                                                id="count-{{ $item->id_cart }}">{{ ((100 - $item->dasarBuku->diskon) / 100) * $item->dasarBuku->harga_asli }}</span>
                                        @else
                                            <span
                                                id="count-{{ $item->id_cart }}">{{ $item->dasarBuku->harga_asli }}</span>
                                        @endif
                                    </td>
                                    @if ($item->dasarBuku->diskon > 0)
                                        <td class="align-middle border-0">
                                            <span class="item-price text-primary fs-3 fw-medium"
                                                id="change-{{ $item->id_cart }}">@rupiah($item->jumlah * ((100 - $item->dasarBuku->diskon) / 100) * $item->dasarBuku->harga_asli)</span>
                                        </td>
                                    @else
                                        <td class="align-middle border-0">
                                            <span class="item-price text-primary fs-3 fw-medium"
                                                id="change-{{ $item->id_cart }}">@rupiah($item->jumlah * $item->dasarBuku->harga_asli)</span>
                                        </td>
                                    @endif
                                    <td class="align-middle border-0 cart-remove">
                                        <button onclick="removeCartItem({{ $item->id_cart }})" width="40"
                                            height="40">x</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="cart-bottom d-flex flex-wrap justify-content-between align-items-center pt-2">
                        <button class="btn btn-dark mb-2" onClick="window.location.reload();">Update cart</button>
                    </div>
                </div>
                <div class="cart-totals padding-medium">
                    <h3 class="pb-4">Cart Total</h3>
                    <div class="total-price pb-5">
                        <table cellspacing="0" class="table text-uppercase">
                            <tbody>
                                <tr class="subtotal pt-2 pb-2 border-top border-bottom border-gray">
                                    <th class="fw-light">Subtotal</th>
                                    <td class="align-middle border-0" data-title="Subtotal">
                                        <span class="price-amount amount text-primary">
                                            <bdi>
                                                <span class="item-price text-primary fs-4"
                                                    id="sum">@rupiah($subtotal)</span>
                                            </bdi>
                                        </span>
                                    </td>
                                </tr>
                                <tr class="order-total pt-2 pb-2 border-bottom border-gray">
                                    <th class="fw-light">Total</th>
                                    <td class="align-middle border-0" data-title="Total">
                                        <span class="price-amount amount text-primary">
                                            <bdi>
                                                <span class="item-price text-primary fs-4">@rupiah($subtotal)</span>
                                            </bdi>
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="button-wrap">
                        <button class="btn btn-dark me-2 mb-2" onClick="window.location.reload();">Update
                            Cart</button>
                        <a href="/books" class="btn btn-dark me-2 mb-2">Continue Shopping</a>
                        @if (count($cartItems) > 0)
                        <a href="/cart/nota" class="btn btn-primary me-2 mb-2">Proceed to checkout</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('frontend.footer')
</body>

</html>

<script>
    function convertRP(data) {
        let rupiahFormat = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
        }).format(data);
        return rupiahFormat.substring(0, rupiahFormat.length - 3);
    }
</script>

<script>
    function updateCartItem(cartItemId, action) {
        $.ajax({
            type: 'PUT',
            url: '/cart/update/',
            data: {
                action: action,
                cartItemId: cartItemId,
            },
            success: function(data) {
                // Update the quantity display
                $('#quantity-' + cartItemId).val(data.data);
                var count = $('#count-' + cartItemId).text();
                // console.log(count);
                $('#change-' + cartItemId).text(convertRP(count * data.data))

                // Update the cart count in the header
                updateCartCount();
                // Update the subtotal and total
                updatePrices();
            }
        });
    }

    function removeCartItem(cartItemId) {
        $.ajax({
            type: 'DELETE',
            url: '/cart/remove/' + cartItemId,
            success: function() {
                // Remove the cart item from the view
                $('#cart-item-' + cartItemId).remove();
                // Update the cart count in the header
                updateCartCount();
                // Update the subtotal and total
                updatePrices();
            }
        });
    }

    function calc_total() {
        var sum = 0;
        $(".total").each(function() {
            sum += parseFloat($(this).text());
        });
        $('#sum').text(sum);
    }

    function updatePrices() {
        // Calculate subtotal and update the display
        var subtotal = 0;
        $('.cart-item').each(function() {
            var quantity = parseInt($(this).find('.quantity').text());
            var price = parseFloat($(this).find('.price').text().replace('$', ''));
            subtotal += quantity * price;
        });
        $('#subtotal').text(subtotal.toFixed(2));

        // Total is the same as the subtotal in this example
        var total = subtotal;
        $('#total').text(total.toFixed(2));
    }

    // Call this function after adding an item to the cart or when the page loads
    updateCartCount();
    updatePrices();
</script>
