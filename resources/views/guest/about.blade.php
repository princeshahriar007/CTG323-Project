@extends('guest.partials.guestMaster')
@section('content')
    <!-- Masthead-->
    <header class="masthead">
        <div class="container d-flex h-100 align-items-center">
            <div class="mx-auto text-center">
                <h1 class="mx-auto my-0 text-uppercase">CONQUEST Technologies</h1>
                <h2 class="text-white-50 mx-auto mt-2 mb-5">A free, responsive, one page Bootstrap theme created by Start Bootstrap.</h2>
                <a class="btn btn-primary js-scroll-trigger" href="#about">Get Started</a>
            </div>
        </div>
    </header>
    <!-- About-->
    <section class="about-section text-center" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2 class="text-white mb-4">Built with Bootstrap 4</h2>
                    <p class="text-white-50">
                        Grayscale is a free Bootstrap theme created by Start Bootstrap. It can be yours right now, simply download the template on
                        <a href="https://startbootstrap.com/template-overviews/grayscale/">the preview page</a>
                        . The theme is open source, and you can use it for any purpose, personal or commercial.
                    </p>
                </div>
            </div>
            <img class="img-fluid" src="assets/img/ipad.png" alt="" />
        </div>
    </section>
@endsection
