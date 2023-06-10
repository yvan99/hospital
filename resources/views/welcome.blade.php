@include('components.homecss')

<nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm" id="mainNav">
    <div class="container px-5">
        <a class="navbar-brand fw-bold" href="#page-top">{{ env('APP_NAME') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="bi-list"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">
                <li class="nav-item"><a class="nav-link me-lg-3" href="#fhi">About</a></li>
                <li class="nav-item"><a class="nav-link me-lg-3" href="#features">What we do</a></li>
            </ul>
            <a href="/doctor/login" class="btn btn-warning rounded-pill px-3 m-1 mb-2 mb-lg-0">
                <span class="d-flex align-items-center">
                    <span class="small">Doctor Login</span>
                </span>
            </a>

            <a href="/receptionist/login" class="btn btn-secondary rounded-pill px-3 m-1 mb-2 mb-lg-0">
                <span class="d-flex align-items-center">
                    <span class="small">Receptionist Login</span>
                </span>
            </a>

            {{-- <a href="/nurse/login" class="btn btn-success rounded-pill px-3 m-1 mb-2 mb-lg-0">
                <span class="d-flex align-items-center">
                    <span class="small">Nurse Login</span>
                </span>
            </a> --}}
        </div>
    </div>
</nav>
<!-- Mashead header-->
<header class="masthead text-white" style="background: #300074">
    <div class="container px-1">
        <div class="row gx-5 align-items-center">
            <div class="col-lg-6">
                <!-- Mashead text and app badges-->
                <div class="mb-5 mb-lg-0 text-center text-lg-start">
                    <h1 class="display-1 lh-1 mb-3">Showcase your app beautifully.</h1>
                    <p class="lead fw-normal text-muted mb-5">Launch your mobile app landing page faster with this free,
                        open source theme from Start Bootstrap!</p>

                </div>
            </div>
            <div class="col-lg-6">
                <!-- Masthead device mockup feature-->


                <img src="homepage/assets/img/nursing2.png" width="600" class="img-fluid" alt="">

            </div>
        </div>
    </div>
    </div>
</header>

<!-- App features section-->
<section id="features">
    <div class="container px-5">
        <div class="row gx-5 align-items-center">
            <div class="col-lg-7 order-lg-1 mb-5 mb-lg-0">
                <div class="container-fluid px-5">
                    <div class="row gx-5">
                        <div class="col-md-6 mb-5">
                            <!-- Feature item-->
                            <div class="text-center">
                                <i class="bi-phone icon-feature text-gradient d-block mb-3"></i>
                                <h3 class="font-alt">Device Mockups</h3>
                                <p class="text-muted mb-0">Ready to use HTML/CSS device mockups, no Photoshop required!
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-5">
                            <!-- Feature item-->
                            <div class="text-center">
                                <i class="bi-camera icon-feature text-gradient d-block mb-3"></i>
                                <h3 class="font-alt">Flexible Use</h3>
                                <p class="text-muted mb-0">Put an image, video, animation, or anything else in the
                                    screen!</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-5 mb-md-0">
                            <!-- Feature item-->
                            <div class="text-center">
                                <i class="bi-gift icon-feature text-gradient d-block mb-3"></i>
                                <h3 class="font-alt">Free to Use</h3>
                                <p class="text-muted mb-0">As always, this theme is free to download and use for any
                                    purpose!</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Feature item-->
                            <div class="text-center">
                                <i class="bi-patch-check icon-feature text-gradient d-block mb-3"></i>
                                <h3 class="font-alt">Open Source</h3>
                                <p class="text-muted mb-0">Since this theme is MIT licensed, you can use it
                                    commercially!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 order-lg-0">
                <img src="homepage/assets/img/nursing.png" width="600" class="img-fluid" alt="">
            </div>
        </div>
    </div>
</section>


<!-- Footer-->
<footer class="bg-black text-center py-5">
    <div class="container px-5">
        <div class="text-white-50 small">
            <div class="mb-2">&copy; Your Website 2023. All Rights Reserved.</div>
        </div>
    </div>
</footer>

@include('components.homejs')
