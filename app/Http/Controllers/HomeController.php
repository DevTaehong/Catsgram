<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;

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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Post $posts, Request $request)
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        
        $id = Auth::id();
        $roleId = DB::table('role_user')->where('id', $id)->get();
        $moderatorId = DB::table('roles')->where('id', 14)->get();
        $users = User::with('roles')->get();

        return view('home', compact('posts', 'id', 'roleId', 'moderatorId', 'users'));
    }

    //Source: https://www.webslesson.info/2020/01/larvel-6-store-retrieve-images-from-mysql-database.html
    function fetch_image($image_id)
    {
        $post = Post::findOrFail($image_id);

        $image_file = Image::make($post->image);

        $response = Response::make($image_file->encode('jpeg'));

        $response->header('Content-Type', 'image/jpeg');

        return $response;
    }
}
