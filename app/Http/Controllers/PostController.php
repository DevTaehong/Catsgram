<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg|max:10240'
        ]);

        if(array_key_exists('image', $data)){
            $fileName = Auth::id() . "-" . $data['image']->getClientOriginalName();

            //Move an image that the user uploads in public/images directory
            $data['image']->move('images', $fileName);
            $data['image'] = $fileName;
        }
        $data['created_by'] = auth()->user()->id;
        Post::create($data);
        return redirect('/home');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('/post/edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = request()->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg|max:10240'
        ]);

        if(array_key_exists('image', $data)){
            $fileName = Auth::id() . "-" . $data['image']->getClientOriginalName();

            //Move an image that the user uploads in public/images directory
            $data['image']->move('images', $fileName);
            $data['image'] = $fileName;
            $post->image = $fileName;
        }

        $post->title = $data['title'];
        $post->content = $data['content'];

        $post->save();

        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $deletedById = auth()->user()->id;

        // Source Code: https://stackoverflow.com/questions/24109535/how-to-update-column-value-in-laravel
        $post->deleted_by = $deletedById;
        $post->save();

        $post->delete();

        return redirect('/home');
    }
}
