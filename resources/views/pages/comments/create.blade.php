@extends('layouts.admin_layout')

@if (Auth::user()->role == 0)

    @section('content')

    <main style="">
        <div class="container-fluid px-4">
            <h1 class="mt-4 text-light">Comment</h1>
            <ol class="breadcrumb mb-4" style="background-color: #212529;">
                <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                <li class="breadcrumb-item active text-light">Comment</li>
            </ol>

            <form action="{{ route('user.comments.store', $portfolio->id) }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="d-flex flex-column align-items-center justify-content-center">
                    <div class="row text-light">
                        <div class="form-group col-md-6 mt-3">
                            <h3>Image</h3>
                            <img style="height: 30vh" src="{{ url($portfolio->image) }}" alt="" class="img-thumbnail">
                            {{-- <input class="mt-3" type="file" name="image"> --}}
                        </div>
        
                        <div class="form-group col-md-6 mt-3">
                            <div class="mb-3">
                                <label for="comment_body">
                                    <h4>Comment</h4>
                                </label>
                                <input type="text" class="form-control" id="comment_body" name="comment_body" placeholder=""
                                    value="">
                            </div>
                            <div class="mb-3">
                                <label for="author">
                                    <h4>Author</h4>
                                </label>
                                <input style="background: lightgray;" type="text" class="form-control" id="client" name="client" placeholder=""
                                    value="{{ Auth::user()->name }}" disabled>
                            </div>
                        </div>
                        <input style="max-width: 20%;" type="submit" name="submit" value="Comment" class="btn btn-primary my-5 mx-auto rounded-pill">
                    </div>
                </div>
            </form>
        </div>
    </main>

    @endsection

@else

    @section('content')

    <main>
        <div class="container-fluid d-flex justify-content-center align-items-center">
            
            <h1 class="text-center text-light fw-bold">YOU CANNOT ACCESS THIS PAGE</h1>

        </div>
    </main>

    @endsection

@endif