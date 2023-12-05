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
              <h1>About Us</h1>
              <div class="breadcrumbs">
                <span class="item">
                  <a href="/">Home ></a>
                </span>
                <span class="item">About</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="company-services" class="padding-xlarge">
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
    <hr>
    <section id="about" class="padding-medium">
      <div class="container">
        <h3 class="py-3">Who are we</h3>
        <div class="row">
          <div class="image-holder col-md-6 mb-3">
            <img src="{{ asset('front-template') }}/images/post-item1.jpg" alt="single" class="img-fluid">
          </div>
          <div class="image-holder col-md-6 mb-3">
            <img src="{{ asset('front-template') }}/images/post-item3.jpg" alt="single" class="img-fluid">
          </div>
        </div>
        <div>
          <p>{{$tentang->deskripsi}}</p>
        </div>
      </div>
    </section>
    <hr>
    <section id="testimonials" class="position-relative padding-xlarge">
      <div class="container">
        <div class="row">
          <div class="offset-md-2 col-md-8">
            <h3 class="text-center mb-5">What our customers says</h3>
            <div class="review-content position-relative">
              <div class="swiper testimonial-swiper">
                <div class="swiper-wrapper">
                  @foreach($ulasanToko as $ulto)
                  <div class="swiper-slide text-center d-flex justify-content-center">
                    <div class="review-item">
                      <blockquote class="fs-1 fw-light">“{{$ulto->ulasan}}”</blockquote>
                      <div class="author-detail">
                        <div class="name fw-bold text-uppercase pt-2">{{$ulto->users->name}}</div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                  <div class="swiper-slide text-center d-flex justify-content-center">
                    <div class="review-item">
                      <blockquote class="fs-1 fw-light">“A pellen tesque pretium feugiat vel morbi sagittis lorem habi tasse cursus. Suspen dise tempus oncu enim pellen tesque este pretium in neque, elit morbi sagittis lorem habi mattis.”</blockquote>
                      <div class="author-detail">
                        <div class="name fw-bold text-uppercase pt-2">Anna garcia</div>
                      </div>
                    </div>
                  </div>
                  <div class="swiper-slide text-center d-flex justify-content-center">
                    <div class="review-item">
                      <blockquote class="fs-1 fw-light">“A pellen tesque pretium feugiat vel morbi sagittis lorem habi tasse cursus. Suspen dise tempus oncu enim pellen tesque este pretium in neque, elit morbi sagittis lorem habi mattis.”</blockquote>
                      <div class="author-detail">
                        <div class="name fw-bold text-uppercase pt-2">Anna garcia</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="swiper-buttons text-center mt-5">
              <button class="swiper-prev testimonial-arrow-prev me-2">
                <svg width="41" height="41"><use xlink:href="#arrow-left"></use></svg>
              </button>
              <span>|</span>
              <button class="swiper-next testimonial-arrow-next ms-2">
                <svg width="41" height="41"><use xlink:href="#arrow-right"></use></svg>
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>
    @include('frontend.footer')
  </body>
</html>
