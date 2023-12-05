<section id="newsletter" class="bg-gray padding-medium">
    <div class="container">
      <div class="newsletter">
        <div class="row">
          <div class="col-lg-6 col-md-12 title">
            <h3>Subscribe to Our Newsletter</h3>
            <p>Get latest news, updates and deals directly mailed to your inbox.</p>
          </div>
          <form class="col-lg-6 col-md-12 d-flex align-items-center" id="form" action="/backend/langganan/store" method="post">
            @csrf
            <div class="d-flex w-75 border-bottom border-dark py-2">
              <input id="newsletter1" type="text" class="form-control border-0 p-0" name="email" placeholder="Your email address here">
              <button class="btn border-0 p-0" type="submit" name="submit">Subscribe</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <footer id="footer" class="overflow-hidden padding-xlarge pb-0">
    <div class="container">
      <div class="row">
        <div class="footer-top-area pb-5">
          <div class="row d-flex flex-wrap justify-content-between">
            <div class="col-lg-3 col-sm-6 pb-3">
              <div class="footer-menu">
                <img src="{{asset('front-template')}}/images/main-logo.png" alt="logo" class="mb-2">
                <p>Nunc tristique facilisis consectetur vivamus ut porta porta aliquam vitae vehicula leo nullam urna lectus.</p>
              </div>
            </div>
            <div class="col-lg-2 col-sm-6 pb-3">
              <div class="footer-menu">
                <h4 class="widget-title pb-2">Quick Links</h4>
                <ul class="menu-list list-unstyled">
                  <li class="menu-item text-uppercase pb-2">
                    <a href="/about">About</a>
                  </li>
                  <li class="menu-item text-uppercase pb-2">
                    <a href="/books">Books</a>
                  </li>
                  <li class="menu-item text-uppercase pb-2">
                    <a href="/contact">Contact</a>
                  </li>
                  {{-- <li class="menu-item text-uppercase pb-2">
                    <a href="login.html">Account</a>
                  </li> --}}
                </ul>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 pb-3">
              <div class="footer-menu contact-item">
                <h4 class="widget-title pb-2">Contact info</h4>
                <ul class="menu-list list-unstyled">
                  <li class="menu-item pb-2">
                    <a href="#">{{$tentang->lokasi}}</a>
                  </li>
                  <li class="menu-item pb-2">
                    <a href="#">{{$tentang->telp}}</a>
                  </li>
                  <li class="menu-item pb-2">
                    <a href="mailto:">{{$tentang->email}}</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 pb-3">
              <div class="footer-menu">
                <h4 class="widget-title pb-2">Social info</h4>
                <p>You can follow us on our social platforms to get updates.</p>
                <div class="social-links">
                  @foreach($sosmed as $sm)
                  <ul class="d-flex list-unstyled">
                    <li>
                      <a href="{{$sm->facebook}}">
                        <svg class="facebook">
                          <use xlink:href="#facebook">
                        </svg>
                      </a>
                    </li>
                    <li>
                      <a href="{{$sm->instagram}}">
                        <svg class="instagram">
                          <use xlink:href="#instagram">
                        </svg>
                      </a>
                    </li>
                    <li>
                      <a href="{{$sm->twitter}}">
                        <svg class="twitter">
                          <use xlink:href="#twitter">
                        </svg>
                      </a>
                    </li>
                    <li>
                      <a href="{{$sm->linkedin}}">
                        <svg class="linkedin">
                          <use xlink:href="#linkedin">
                        </svg>
                      </a>
                    </li>
                    <li>
                      <a href="{{$sm->youtube}}">
                        <svg class="youtube">
                          <use xlink:href="#youtube">
                        </svg>
                      </a>
                    </li>
                  </ul>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr>
    </div>
  </footer>
  <div id="footer-bottom">
    <div class="container">
      <div class="row d-flex flex-wrap justify-content-between">
        <div class="col-12">
          <div class="copyright">
            <p>© Copyright 2023 Micas. HTML Template by <a href="https://templatesjungle.com/" target="_blank"><b>TemplatesJungle</b></a></p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Video Popup -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><svg class="bi" width="40" height="40"><use xlink:href="#close-sharp"></use></svg></button>
                <div class="ratio ratio-16x9">
                  <iframe class="embed-responsive-item" src="" id="video"  allowscriptaccess="always" allow="autoplay"></iframe>
                </div>
            </div>

        </div>

    </div>
  </div>

  <script type="text/javascript" src="{{asset('front-template')}}/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="{{asset('front-template')}}/js/plugins.js"></script>
  <script type="text/javascript" src="{{asset('front-template')}}/js/script.js"></script>
