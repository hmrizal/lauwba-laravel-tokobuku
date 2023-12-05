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
        <div class="container">
            <div class="row">
                <div class="text-center padding-medium no-padding-bottom">
                    <h1>Sign in to shop</h1>
                    <div class="breadcrumbs">
                        <span class="item">You are here:
                            <a href="/">Home ></a>
                        </span>
                        <span class="item">Account</span>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <section class="login-tabs padding-xlarge">
        <div class="container">
            <div class="row">
                <div class="tabs-listing">
                    <nav>
                        <div class="nav nav-tabs d-flex justify-content-center" id="nav-tab" role="tablist">
                            <button class="nav-link fw-light text-uppercase active" id="nav-sign-in-tab"
                                data-bs-toggle="tab" data-bs-target="#nav-sign-in" type="button" role="tab"
                                aria-controls="nav-sign-in" aria-selected="true">Sign In</button>
                            <button class="nav-link fw-light text-uppercase" id="nav-register-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-register" type="button" role="tab"
                                aria-controls="nav-register" aria-selected="false">Register</button>
                        </div>
                    </nav>
                    <div class="bg-gray tab-content" id="nav-tabContent">
                        <div class="tab-pane fade active show" id="nav-sign-in" role="tabpanel"
                            aria-labelledby="nav-sign-in-tab">
                            <form action="/login" method="POST">
                                @csrf
                                <div class="form-group py-3">
                                    <label for="sign-in">Email address *</label>
                                    <input type="text" minlength="2" name="email" placeholder="Your Email"
                                        class="w-100" required>
                                </div>
                                <div class="form-group py-3">
                                    <label for="sign-in">Password *</label>
                                    <input type="password" minlength="2" name="password" placeholder="Your Password"
                                        class="w-100" required>
                                </div>
                                <label class="py-3">
                                    <input type="checkbox" required="" class="d-inline">
                                    <span class="label-body">Remember Me</span>
                                    <span class="label-body"><a href="#" class="fw-bold">Forgot
                                            Password</a></span>
                                </label>
                                <button type="submit" name="submit" class="btn btn-dark w-100 my-3">Login</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="nav-register" role="tabpanel" aria-labelledby="nav-register-tab">
                            <form action="/customer/store" method="POST">
                                @csrf
                                <div class="form-group py-3">
                                    <label for="register">Name *</label>
                                    <input type="text" minlength="2" name="name" placeholder="Input Your Name"
                                        class="w-100" required>
                                </div>
                                <div class="form-group py-3">
                                    <label for="register">Email address *</label>
                                    <input type="text" minlength="2" name="email"
                                        placeholder="Input Your Email Address" class="w-100" required>
                                </div>
                                <div class="form-group py-3">
                                    <label for="register">Password *</label>
                                    <input type="password" minlength="2" name="password" placeholder="Your Password"
                                        class="w-100" required>
                                </div>
                                <label class="py-3">
                                    <input type="checkbox" required="" class="d-inline">
                                    <span class="label-body">I agree to the <a href="#" class="fw-bold">Privacy
                                            Policy</a></span>
                                </label>
                                <button type="submit" name="submit"
                                    class="btn btn-dark w-100 my-3">Register</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('frontend.footer')
</body>

</html>
