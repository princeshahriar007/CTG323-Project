@extends('guest.partials.guestMaster')
@section('content')
    <!-- Masthead-->
    <header class="masthead">
        <div class="container d-flex h-100 align-items-center">
            <div class="mx-auto text-center">
                @if(session('regSuccess'))
                    <p class="alert alert-success col-lg-12"> {{ session('regSuccess') }}</p>
                @endif
                    @if(session('verifySuccess'))
                        <p class="alert alert-success col-lg-12"> {{ session('verifySuccess') }}</p>
                    @endif
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
    <!-- Projects-->
    <section class="projects-section bg-light" id="projects">
        <div class="container">
            <!-- Featured Project Row-->
            <div class="row align-items-center no-gutters mb-4 mb-lg-5">
                <div class="col-xl-8 col-lg-7"><img class="img-fluid mb-3 mb-lg-0" src="assets/img/bg-masthead.jpg" alt="" /></div>
                <div class="col-xl-4 col-lg-5">
                    <div class="featured-text text-center text-lg-left">
                        <h4>Shoreline</h4>
                        <p class="text-black-50 mb-0">Grayscale is open source and MIT licensed. This means you can use it for any project - even commercial projects! Download it, customize it, and publish your website!</p>
                    </div>
                </div>
            </div>
            <!-- Project One Row-->
            @foreach($posts as $post)
                @if($post->id % 2 == 1)
                    <div class="row justify-content-center no-gutters mb-5 mb-lg-0">
                        <div class="col-lg-6"><img class="img-fluid" src="assets/img/demo-image-01.jpg" alt="" /></div>
                        <div class="col-lg-6">
                            <div class="bg-black text-center h-100 project">
                                <div class="d-flex h-100">
                                    <div class="project-text w-100 my-auto text-center text-lg-left">
                                        <h4 class="text-white">{{ $post->title }}</h4>
                                        <p class="mb-0 text-white-50">{!! Illuminate\Support\Str::limit(strip_tags($post->details, 50))  !!}...</p>
                                        <a class="btn btn-light" href="{{url('/post/'.$post->id.'/view')}}">Read More</a>
                                        <hr class="d-none d-lg-block mb-0 ml-0" />
                                        <p class="mb-0 text-white-50 post-meta">Posted by
                                            <a href="#"> {{ $post->user->name }}</a>
                                            on {{ $post->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if($post->id % 2 == 0)
                    <!-- Project Two Row-->
                    <div class="row justify-content-center no-gutters">
                        <div class="col-lg-6"><img class="img-fluid" src="assets/img/demo-image-02.jpg" alt="" /></div>
                        <div class="col-lg-6 order-lg-first">
                            <div class="bg-black text-center h-100 project">
                                <div class="d-flex h-100">
                                    <div class="project-text w-100 my-auto text-center text-lg-right">
                                        <h4 class="text-white">{{ $post->title }}</h4>
                                        <p class="mb-0 text-white-50">{!! Illuminate\Support\Str::limit(strip_tags($post->details, 50))  !!}...</p>
                                        <a class="btn btn-light btn-sm" href="{{url('/post/'.$post->id.'/view')}}">Read More</a>
                                        <hr class="d-none d-lg-block mb-0 mr-0" />
                                        <p class="mb-0 text-white-50 post-meta">Posted by
                                            <a href="#"> {{ $post->user->name }}</a>
                                            on {{ $post->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
            <p>{{ $posts->links() }}</p>
        </div>
    </section>

@endsection
