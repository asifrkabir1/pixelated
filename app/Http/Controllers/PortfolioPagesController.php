<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PortfolioPagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $portfolios = Portfolio::all();
        return view('pages.portfolios.list', compact('portfolios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.portfolios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'image' => 'required|image',
            'description' => 'required|string',
            'category' => 'required|string',
        ]);

        $portfolios = new Portfolio;
        $portfolios->title = $request->title;
        $portfolios->description = $request->description;
        $portfolios->author = Auth::user()->name;
        $portfolios->likes = 0;
        $portfolios->category = $request->category;

        $image = $request->file('image');
        Storage::putFile('public/img/', $image);
        $portfolios->image = "storage/img/".$image->hashName();

        $portfolios->save();

        return redirect()->route('user.portfolios.list')->with('success', 'Image Uploaded Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $portfolio = Portfolio::find($id);
        return view('pages.portfolios.edit', compact('portfolio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'description' => 'required|string',
            'category' => 'required|string',
        ]);

        $portfolios = Portfolio::find($id);
        $portfolios->title = $request->title;
        $portfolios->description = $request->description;
        $portfolios->category = $request->category;

        $portfolios->save();

        return redirect()->route('user.portfolios.list')->with('success', 'Post Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $portfolio = Portfolio::find($id);
        @unlink(public_path($portfolio->image));
        $portfolio->delete();

        return redirect()->route('user.portfolios.list')->with('success', 'Post Deleted Successfully');
    }

    public function like($id)
    {
        $portfolio = Portfolio::find($id);
        $like = $portfolio->likes;
        $like = $like + 1;
        $portfolio->likes = $like;

        $portfolio->save();

        return redirect()->route('home');
    }

    public function profile()
    {
        $portfolios = Portfolio::all();
        $comments = Comment::all();
        return view('pages.profile', compact('portfolios', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editProfile()
    {
        return view('pages.profiles.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            // 'name' => 'required|string',
            'bio' => 'string',
        ]);

        $user = User::find(Auth::user()->id);
        $user->biography = $request->biography;
        // $user->name = $request->name;

        if($request->file('image'))
        {
            $image = $request->file('image');
            Storage::putFile('public/img/', $image);
            $profileImage = "storage/img/".$image->hashName();
            $user->profile_photo_path = $profileImage;
        }

        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profile Updated Successfully');
    }
}
