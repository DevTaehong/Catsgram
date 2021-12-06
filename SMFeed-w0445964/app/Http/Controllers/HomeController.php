<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Support\Facades\Auth;

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
    public function index(Post $posts)
    {
        $posts = Post::orderBy('created_at', 'desc')->get();

        $id = Auth::id();
        $roleId = \DB::table('role_user')->where('id', $id)->get();
        $moderatorId = \DB::table('roles')->where('id', 2)->get();


        return view('home', compact('posts', 'id', 'roleId', 'moderatorId'));
    }
}
