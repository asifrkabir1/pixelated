<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Pixelated</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link rel="icon" href="{{ asset('assets/pixels.png') }}" type="image/png">

    <style>
        @keyframes float {
            0% {
                transform: translatey(0px);
            }
            50% {
                transform: translatey(-20px);
            }
            100% {
                transform: translatey(0px);
            }
        }

        #float {
            width: 100px;
            height: 100px;
            transform: translatey(0px);
            animation: float 2s ease-in-out infinite;
        }

        nav ul li a {
            display: block;
            position: relative;
            transition: all 0.5s ease-in-out;
        }

        nav ul li a::after {
            content: "";
            position: absolute;
            width: 0;
            height: 1px;
            background-color: #0077ff;
            left: 0;
            right: 0;
            margin: 0 auto;
            bottom: 0;
            transition: all 0.5s ease-in-out;
        }

        nav ul li a:hover::after {
            width: 90%;
        }

        .blue-glow-btn{
            transition: all 0.4s ease-in-out;
        }

        .blue-glow-btn:hover {
            box-shadow: 0px 0px 50px #2787f5;
        }

        .logout-btn:hover{
            background-color: #ffffff;
        }

        .float-card{
            transition: all 0.4s ease-in-out;
        }

        .float-card:hover{
            transform: translateY(-20px);
        }

    </style>
</head>

<body id="page-top" class="bg-dark">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('assets/pixels_bw.png') }}" alt=""> PIXELATED</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0 d-flex flex-row justify-content-center align-items-center">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#portfolio">Images</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('user.portfolios.create') }}">Upload</a></li>
                    @if (Auth::user()->profile_photo_path != null)
                        <li class="nav-item"><a class="nav-link" href="{{ route('user.portfolios.list') }}"><img style="height: 40px; width: 40px; border: 1px solid #0077ff;" class="rounded-circle" src="{{ url(Auth::user()->profile_photo_path) }}" alt=""></a></li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('user.portfolios.list') }}">{{ Auth::user()->name }}</a></li>
                    @endif
                    <li class="nav-item btn btn-primary rounded-pill blue-glow-btn logout-btn"><a class="nav-link" href="{{ route('logout') }}">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- @if (Auth::user())
        <h3>{{ Auth::user()->name }}</h3>
    @endif --}}

    <!-- Portfolio Grid-->
    <section style="min-height: 100vh; margin-top: 100px;" class="page-section bg-dark pt-5" id="portfolio">
        <div class="container">
            <div class="text-center mb-5">
                @if (Auth::user()->profile_photo_path != null)
                    <img style="border: 3px solid #0077ff;" class="rounded-circle mb-3" src="{{ url(Auth::user()->profile_photo_path) }}" alt="">
                @endif
                <div class="d-flex flex-column align-items-center">
                    <h2 class="section-heading text-uppercase text-light mb-3 mt-3">@ {{ Auth::user()->name }}</h2>
                    <p style="width: 60%;" class="text-light text-center mb-5">{{ Auth::user()->biography }}</p>
                </div>
                <a style="font-family: 'Montserrat" href="{{ route('user.profile.edit') }}"><button class="btn btn-primary mb-5">Edit Profile</button></a>
                {{-- <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3> --}}
            </div>
            <div class="row">
                @if (count($portfolios) > 0)
                @foreach ($portfolios as $portfolio)
                @if ($portfolio->author == Auth::user()->name)
                <div class="col-lg-4 col-sm-6 mb-4 float-card">
                    <div class="portfolio-item">
                        <a class="portfolio-link" data-bs-toggle="modal"
                            href="#portfolioModal<?php echo $portfolio->id?>"
                            data-bs-target="#portfolioModal<?php echo $portfolio->id?>">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="{{ url($portfolio->image) }}" alt="..." />
                        </a>
                        <div class="portfolio-caption">
                            <div style="font-size: 20px;" class="portfolio-caption-heading">{{ $portfolio->title }}</div>
                            <div class="portfolio-caption-subheading text-muted my-3"><img style="height: 40px; width: 40px; border: 1px solid #0077ff;" class="rounded-circle" src="{{ url(Auth::user()->profile_photo_path) }}" alt=""></div>
                            <div class="portfolio-caption-subheading text-muted"><span>@</span>{{ $portfolio->author }}</div>
                        </div>
                    </div>
                </div>
                <div class="portfolio-modal modal fade" id="portfolioModal<?php echo $portfolio->id?>" tabindex="-1" role="dialog"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="close-modal" data-bs-dismiss="modal"><img src="{{ asset('assets/img/close-icon.svg') }}"
                                alt="Close modal" /></div>
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8">
                                        <div class="modal-body d-flex justify-content-center align-items-center flex-column">
                                            <!-- Project details-->
                                            <h2 class="text-uppercase">{{ $portfolio->title }}</h2>
                                            <img class="img-fluid d-block mx-auto" src="{{ url($portfolio->image) }}" alt="..." />
                                            <p>{{ $portfolio->description }}</p>
                                            <ul class="list-inline">
                                                <li>
                                                    <strong>Uploaded:</strong>
                                                    {{ $portfolio->created_at->toDateString() }}
                                                </li>
                                                <li>
                                                    <strong>Uploaded by:</strong>
                                                    {{ $portfolio->author }}
                                                </li>
                                                <li>
                                                    <strong>Category:</strong>
                                                    {{ $portfolio->category }}
                                                </li>
                                                <li>
                                                    <strong>Likes: <a href="{{ route('user.portfolios.like', $portfolio->id) }}"><i class="fas fa-heart"></i></a></strong>
                                                    {{ $portfolio->likes }}
                                                </li>
                                            </ul>
                                            <div>
                                                <a href="{{ route('user.comments.create', $portfolio->id) }}"><button class="btn btn-primary btn-xl text-uppercase rounded-pill"
                                                    type="button">
                                                    <i class="fas fa-comment-dots"></i>
                                                    Comment
                                                </button></a>
                                                <button class="btn btn-danger btn-xl text-uppercase rounded-pill" data-bs-dismiss="modal"
                                                    type="button">
                                                    <i class="fas fa-times me-1"></i>
                                                    Close
                                                </button>
                                            </div>
                                            <div>
                                                <h4 class="mt-5">Comments: </h4>
                                                <div>
                                                    @if (count($comments) > 0)
                                                        @foreach ($comments as $comment)
                                                            @if ($comment->post_id == $portfolio->id)
                                                                <div style="text-align: center; box-shadow: 0px 10px 10px #4ea7fb48; border-radius: 15px;" class="mb-3 p-2">
                                                                    <p class="mb-1"><i class="fas fa-user"></i> <strong>{{ $comment->commenter }}</strong>: {{ $comment->comment_body }}</p>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
                @endif
            </div>
        </div>
    </section>
    
    <!-- Footer-->
    <footer class="footer py-4 text-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 text-lg-start">Copyright &copy; Asif Rezwan Kabir 2021</div>
                <div class="col-lg-4 my-3 my-lg-0">
                    <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a class="link-dark text-decoration-none me-3 text-light" href="#!">Privacy Policy</a>
                    <a class="link-dark text-decoration-none text-light" href="#!">Terms of Use</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('js/scripts.js') }}"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>

</html>