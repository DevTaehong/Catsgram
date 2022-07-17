<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
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
            'image' => 'image|mimes:jpg,png,jpeg|max:2048'
        ]);

        if(array_key_exists('image', $data)) {
            //Source: https://www.webslesson.info/2020/01/larvel-6-store-retrieve-images-from-mysql-database.html
            $image_file = $request->image;
            $image = Image::make($image_file);
            Response::make($image->encode('jpeg'));
        } else{ $image = null;}

        $form_data = array(
            'title'  => $data['title'],
            'content' => $data['content'],
            'image' => $image,
            'created_by' => Auth::id()
        );

        Post::create($form_data);

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
            'image' => 'image|mimes:jpg,png,jpeg|max:2048'
        ]);

        if(array_key_exists('image', $data)) {
            //Source: https://www.webslesson.info/2020/01/larvel-6-store-retrieve-images-from-mysql-database.html
            $image_file = $request->image;
            $image = Image::make($image_file);
            Response::make($image->encode('jpeg'));
        } else{ $image = null;}

        $post->title = $data['title'];
        $post->content = $data['content'];
        $post->image = $image;

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
