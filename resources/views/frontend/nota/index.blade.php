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
    <section class="shopify-cart checkout-wrap padding-large">
        <div class="container">
            <div class="row d-flex flex-wrap">
                <div class="col-md-12">
                    <div class="text-center">
                        <img src="{{ asset('front-template') }}/images/main-logo.png" alt="" width="350px"
                            height="150px">
                        <p>{{ $nota['id_nota'] }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <table>
                        {{-- @php
                            $user = App\Models\User::find($cart->id)
                        @endphp --}}
                        {{-- @foreach ($cart as $c) --}}
                        <tr>
                            <td width="30%">Customer</td>
                            <td>:</td>
                            <td>{{ $nota->users->name }}</td>
                        </tr>
                        {{-- @endforeach --}}
                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td>{{ $nota->alamat }}, {{ $nota->kode_pos }}</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>:</td>
                            <td>{{ $nota->phone }}</td>
                        </tr>
                        {{-- @foreach ($cart as $c) --}}
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td>{{ $nota->users->email }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table>
                        <tr>
                            <td width='30%'>MICAS Bookstore</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td>{{ $tentang->lokasi }}</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>:</td>
                            <td>{{ $tentang->telp }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td>{{ $tentang->email }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-12 mt-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td>No.</td>
                                <td>Buku</td>
                                <td>Jumlah</td>
                                <td>Harga</td>
                                <td>Subtotal</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1 @endphp
                            @foreach ($cart as $c)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $c->dasarBuku->judul }}</td>
                                    <td>{{ $c->jumlah }}</td>
                                    @if ($c->dasarBuku->diskon > 0)
                                        <td>@rupiah(((100 - $c->dasarBuku->diskon) / 100) * $c->dasarBuku->harga_asli)</td>
                                    @else
                                        <td>@rupiah($c->dasarBuku->harga_asli)</td>
                                    @endif
                                    @if ($c->dasarBuku->diskon > 0)
                                        <td>@rupiah($c->jumlah * ((100 - $c->dasarBuku->diskon) / 100) * $c->dasarBuku->harga_asli)</td>
                                    @else
                                        <td>@rupiah($c->jumlah * $c->dasarBuku->harga_asli)</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4 offset-md-8">
                    <table class="table table-bordered">
                        <tr>
                            <td>Subtotal</td>
                            <td>:</td>
                            <td>@rupiah($subtotal)</td>
                        </tr>
                        <tr>
                            <td>Tax (2%)</td>
                            <td>:</td>
                            <td>@rupiah($tax)</td>
                        </tr>
                        <tr>
                            <td>Shipping</td>
                            <td>:</td>
                            <td>@rupiah($shipping)</td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td>:</td>
                            <td>@rupiah($nota->total_harga)</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>
    @include('frontend.footer')
</body>

</html>
