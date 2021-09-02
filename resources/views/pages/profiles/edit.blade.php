@extends('layouts.admin_layout')

@if (Auth::user()->role == 0)
    
    @section('content')

        <main style="">
            <div class="container-fluid px-4">
                <h1 class="mt-4 text-light">Update Profile</h1>
                <ol class="breadcrumb mb-4" style="background-color: #212529;">
                    <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                    <li class="breadcrumb-item active text-light">Update Profile</li>
                </ol>

                <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <div class="row text-light">
                            <div class="form-group col-md-6 mt-3">
                                <h3>Profile Picture</h3>
                                {{-- <img style="height: 30vh" src="https://via.placeholder.com/500/000000/FFFFFF/?text=Upload+Image" alt="" class="img-thumbnail"> --}}
                                <input class="mt-3" type="file" name="image">
                            </div>
            
                            <div class="form-group col-md-6 mt-3">
                                <div class="mb-3">
                                    <label for="name">
                                        <h4>Name</h4>
                                    </label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder=""
                                        value="{{ Auth::user()->name }}" disabled>
                                </div>
                            </div>
            
                            <div class="form-group col-md-12 mt-3">
                                <h3>Biography</h3>
                                <textarea class="form-control" name="biography" rows="5">{{ Auth::user()->biography }}</textarea>
                            </div>
                            <input style="max-width: 20%;" type="submit" name="submit" value="Update" class="btn btn-primary my-5 mx-auto rounded-pill">
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