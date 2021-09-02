<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $portfolios = Portfolio::all();
        return view('pages.admin.list', compact('portfolios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.create');
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

        return redirect()->route('pages.admin.list')->with('success', 'Image Uploaded Successfully');
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
        return view('pages.admin.edit', compact('portfolio'));
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

        return redirect()->route('admin.list')->with('success', 'Post Updated Successfully');
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

        return redirect()->route('admin.list')->with('success', 'Post Deleted Successfully');
    }

    public function like($id)
    {
        $portfolio = Portfolio::find($id);
        $like = $portfolio->like;
        $like = $like + 1;
        $portfolio->likes = $like;

        $portfolio->save();

        return redirect()->route('home');
    }
}
