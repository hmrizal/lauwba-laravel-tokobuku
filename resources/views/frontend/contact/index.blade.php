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
    <section class="hero-section bg-gray d-flex align-items-center justify-content-center padding-medium pb-5">
      <div class="hero-content">
        <div class="container">
          <div class="row">
            <div class="text-center padding-medium no-padding-bottom">
              <h1>Contact Us</h1>
              <div class="breadcrumbs">
                <span class="item">
                  <a href="/">Home ></a>
                </span>
                <span class="item">Contact</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div class="contact-us padding-xlarge">
      <div class="container">
        <div class="row">
          <div class="contact-info col-lg-6 pb-3">
            <h3>Contact info</h3>
            <div class="contact-address pt-3 pb-3">
                <span>{{$tentang->lokasi}}</span>
            </div>
            <div class="contact-number pb-3">
                <span>
                  <a href="#">{{$tentang->telp}}</a>
                </span>
            </div>
            <div class="email-address pb-3">
                <span>
                  <a href="#">{{$tentang->email}}</a>
                </span>
            </div>
            <div class="contact-address padding-xlarge">
                <h4><strong>How about reviewing our store?</strong></h4>
                @if (Auth::check())
                    <a href="/ulasantoko/create"
                        class="btn btn-dark me-2 mb-1">Review our store</a>
                @else
                    <a href="{{ route('customer.login') }}" class="btn btn-dark me-2 mb-1">Review our store</a>
                @endif
            </div>
          </div>
          <div class="inquiry-item col-lg-6">
            <h3>Any questions?</h3>
            <p>Use the form below to get in touch with us.</p>
            <form id="form" action="/backend/mailbox/store" method="post">
              @csrf
              <div class="py-3">
                <label>Your Name *</label>
                <input type="text" name="nama" placeholder="Write your name here" class="w-100" required>
              </div>
              <div class="py-3">
                <label>Your Email *</label>
                <input type="text" name="email" placeholder="Write your email here" class="w-100">
              </div>
              <div class="py-3">
                <label>Subject *</label>
                <input type="text" name="judul" placeholder="Write your subject here" class="w-100">
              </div>
              <div class="py-3">
                <label>Your Message *</label>
                <textarea placeholder="Write Your Message Here" class="w-100" cols=50 rows=8 name="pesan"></textarea>
              </div>
              <button type="submit" name="submit" class="btn btn-dark w-100 my-3">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <hr>
    @include('frontend.footer')
  </body>
</html>
