@extends('layouts.admin_layout')

@section('content')

<main style="">
    <div class="container-fluid px-4">
        <h1 class="mt-4 text-light">Create</h1>
        <ol class="breadcrumb mb-4" style="background-color: #212529;">
            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
            <li class="breadcrumb-item active text-light">Create</li>
        </ol>

        <form action="{{ route('user.portfolios.store') }}" method="POST" enctype="multipart/form-data">

            @csrf
            {{ method_field('PUT') }}

            <div class="d-flex flex-column align-items-center justify-content-center">
                <div class="row text-light">
                    <div class="form-group col-md-6 mt-3">
                        <h3>Image</h3>
                        {{-- <img style="height: 30vh" src="https://via.placeholder.com/500/000000/FFFFFF/?text=Upload+Image" alt="" class="img-thumbnail"> --}}
                        <input class="mt-3" type="file" name="image">
                    </div>
    
                    <div class="form-group col-md-6 mt-3">
                        <div class="mb-3">
                            <label for="title">
                                <h4>Title</h4>
                            </label>
                            <input type="text" class="form-control" id="title" name="title" placeholder=""
                                value="">
                        </div>
                        <div class="mb-3">
                            <label for="author">
                                <h4>Author</h4>
                            </label>
                            <input style="background: lightgray;" type="text" class="form-control" id="client" name="client" placeholder=""
                                value="{{ Auth::user()->name }}" disabled>
                        </div>
                        <div class="mb-5">
                            <label for="category">
                                <h4>Category</h4>
                            </label>
                            <input type="text" class="form-control" id="category" name="category" placeholder=""
                                value="">
                        </div>
                    </div>
    
                    <div class="form-group col-md-12 mt-3">
                        <h3>Description</h3>
                        <textarea class="form-control" name="description" rows="5"></textarea>
                    </div>
                    <input style="max-width: 20%;" type="submit" name="submit" value="Upload" class="btn btn-primary my-5 mx-auto rounded-pill">
                </div>
            </div>
        </form>
    </div>
</main>

@endsection