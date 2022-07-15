<?php

namespace App\Http\Controllers;

use App\Post;
use App\Theme;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth'); // It's just a function
//        $this->middleware('IsLegalAge')->only('index');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index(Post $posts, Request $request)
    {
        $posts = Post::orderBy('created_at', 'desc')->get();

        $id = Auth::id();
        $roleId = DB::table('role_user')->where('id', $id)->get();
        $moderatorId = DB::table('roles')->where('id', 14)->get();

        $themes = Theme::all();

//        $value = $request->cookie('name3');
        $value = $request->cdn_url;
        Cookie::queue(Cookie::make('name1', $value, 20));

        $users = User::with('roles')->get();

        return view('home', compact('posts', 'id', 'roleId', 'moderatorId', 'themes', 'value', 'users'));
    }
}
