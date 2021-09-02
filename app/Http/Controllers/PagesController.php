<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    // public function index(){
    //     $main = Main::first();
    //     $services = Service::all();
    //     $portfolios = Portfolio::all();
    //     $abouts = About::all();
    //     return view('pages.index', compact('main', 'services', 'portfolios', 'abouts'));
    // }

    public function index(){
        $portfolios = Portfolio::all();
        $comments = Comment::all();
        $users = User::all();
        return view('pages.index', compact('portfolios', 'comments', 'users'));
    }

    public function dashboard(){
        return view('pages.dashboard');
    }

    public function services(){
        return view('pages.services');
    }

    public function portfolio(){
        return view('pages.portfolio');
    }

    public function about(){
        return view('pages.about');
    }

    public function contact(){
        return view('pages.contact');
    }

    // public function search(Request $request){
    //     $query = $request->search;
    //     if($request->ajax()){
    //         $portfolios = DB::table('portfolios')->where('category', '=', 'Photography')->get();
    //     }
        
    //     return view('pages.index', compact('portfolios'))->render();
    // }
}
