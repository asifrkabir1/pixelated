@extends('layouts.admin_layout')

@if (Auth::user()->role == 0)
    
    @section('content')

        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">List of Images</h1>
                <ol class="breadcrumb mb-4" style="background-color: #212529;">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active text-light">List of Images</li>
                </ol>

                <table class="table table-bordered table-dark">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Image</th>
                            <th scope="col">Author</th>
                            <th scope="col">Likes</th>
                            <th scope="col">Category</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($portfolios) > 0)
                            @foreach($portfolios as $portfolio)
                                @if ($portfolio->author == Auth::user()->name)
                                    <tr>
                                        <th scope="row">{{ $portfolio->id }}</th>
                                        <td>{{ $portfolio->title }}</td>
                                        <td>{{ Str::limit(strip_tags($portfolio->description), 40) }}</td>
                                        <td>
                                            <img style="height: 10vh" src="{{ url($portfolio->image) }}" alt="image">
                                        </td>
                                        <td>{{ $portfolio->author }}</td>
                                        <td>{{ $portfolio->likes }}</td>
                                        <td>{{ $portfolio->category }}</td>
                                        <td>
                                            <div class="row">
                                                <div>
                                                    <a href="{{ route('user.portfolios.edit', $portfolio->id) }}"
                                                        class="btn btn-primary m-2">Edit</a>
                                                </div>
                                                <div>
                                                    <form action="{{ route('user.portfolios.destroy', $portfolio->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="submit" name="submit" value="Delete" class="btn btn-danger m-2">
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                    </tbody>
                </table>
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