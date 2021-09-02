<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {

        $role = Auth::user()->role;

        if ($role == '1') {
            // return view('admin.dashboard');
            $portfolios = Portfolio::all();
            $comments = Comment::all();
            $users = User::all();
            return view('pages.admin.list', compact('portfolios', 'comments', 'users'));
        } else {
            // return view('dashboard');
            $portfolios = Portfolio::all();
            $comments = Comment::all();
            $users = User::all();
            return view('pages.index', compact('portfolios', 'comments', 'users'));
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
