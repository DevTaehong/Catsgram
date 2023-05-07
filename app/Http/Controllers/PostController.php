<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\Http;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

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
        // Validate data that a user tries to upload
        $data = request()->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg|max:2048|required'
        ]);

        // Get a image's url from Cloudinary
        // Source: https://stackoverflow.com/questions/68477781/how-upload-images-with-cloudinary-laravel
        $result = $request->image->storeOnCloudinary();
        $path = $result->getPath();
        
        // Call Clarifai API using cURL
        $response = Http::withHeaders([
            "Authorization" => "Key b9e7ba837c1e4df689447923269157d3",
            'Content-Type' => 'application/json'
        ])->post('https://api.clarifai.com/v2/users/clarifai/apps/main/models/general-image-recognition/versions/aa7f35c01e0642fda5cf400f543e7c40/outputs', [
            'inputs' => [
                [
                    'data' => [
                        'image' => [
                            'url' => $path,
                        ],
                    ],
                ],
            ],
        ]);
        
        // If the API call failed...
        if ($response->failed()) {
            redirect('flash-message');
        } else {
            $clarifaiOutputs = $response->json();
            $output = $clarifaiOutputs['outputs'][0]['data']['concepts'][0]['name'];
            
            // Check if a user submits a cat's image from the API's outputs
            if($output != 'cat') {
                return back()->with('error', 'You can only upload an image of a cat.');
            }
        }

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
            'image' => 'image|mimes:jpg,png,jpeg|max:2048|required'
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
