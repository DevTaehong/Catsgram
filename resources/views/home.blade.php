@extends('layouts.app')
<link rel="stylesheet" href="{{ URL::asset('css/postImage.css') }}">
@section('content')
    @foreach($posts as $post)
        <div class="container">
            @if(\Illuminate\Support\Facades\Auth::check())
                <div class="row">
            @else
                <div class="row justify-content-center">    
            @endif   
                @if(\Illuminate\Support\Facades\Auth::check())
                    <div id="profile" class="col-md-3 w-25 d-none d-md-block" userName="{{Auth::user()->name}}" 
                        userEmail="{{Auth::user()->email}}"
                        signupDate="{{\Carbon\Carbon::parse(Auth::user()->created_at)->diffForHumans()}}"
                        editProfile="{{ Auth::user()->id }}"
                    >
                    </div>
                @endif 
                <div class="col-md-6">
                    @if(\Illuminate\Support\Facades\Auth::check())
                        <div id="postImage"></div>
                    @endif 
                    <div class="rounded-4 card shadow-sm mt-2">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @foreach($users as $user)
                            @if($user->id == $post->created_by)
                                <div class="mt-3 ml-3 d-flex flex-start align-items-center">
                                    <div>
                                        {{-- <img class="rounded-circle shadow-1-strong me-3"
                                            src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp" alt="avatar" width="40" height="40" 
                                        /> --}}
                                    </div>
                                    <div class="d-flex flex-column mr-auto">
                                        <strong class="ml-0 mr-1 font-weight-bold">{{ $user->name }}</strong>
                                        <small class="ml-0 text-secondary">{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</small>
                                    </div>
                                    <div class="dropleft">
                                        
                                        @if($post->created_by == $id or
                                                implode(', ', $moderatorId->pluck('id')->toArray()) ==
                                                (implode(', ', $roleId->pluck('role_id')->toArray())))
                                            <button class="mr-3 btn btn-light p-2 rounded-circle .bg-transparent" type="button" data-toggle="dropdown" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                                    <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                                                </svg>    
                                            </button>
                                            <div class="dropdown-menu">
                                                @if($post->created_by == $id)
                                                    <a class="dropdown-item" href="{{ route('posts.edit',$post->id) }}">Edit</a>
                                                @endif
                                                @if($post->created_by == $id or
                                                    implode(', ', $moderatorId->pluck('id')->toArray()) ==
                                                    (implode(', ', $roleId->pluck('role_id')->toArray())))
                                                    <form action="/posts/{{ $post->id }}" method="post" style="display: inline">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="dropdown-item text-danger">Delete</button>
                                                    </form>
                                                @endif
                                            </div>
                                        @endif     
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        
                        <div class="mt-1 ml-3 mb-1">{{ $post->content }}</div>
                        @if($post->image != null)
                            <img style="width: 100%; max-width: 100%; height: 80%;" alt="User images"
                                class="responsive" src="store_image/fetch_image/{{$post->id}}"/>
                        @endif
                        {{-- Comments --}}
                        <div class="col-md">
                            <hr />
                            <h5>Comments</h5>
                        </div>
                        @include('post.commentsDisplay',
                            ['comments' => $post->comments, 'post_id' => $post->id,
                            'post_created_by' => $post->created_by, 'id' => $id])
                        <div class="col-md">
                            <hr />
                        </div>

                        {{-- Comment button --}}
                        @if(Auth::user())
                            <form method="post" action="{{ route('comments.store') }}">
                                @csrf
                                <div class="col-md">
                                    <div class="form-group d-flex flex-row align-items-center">
                                        {{-- <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp" width="50" class="rounded-circle mr-2">  --}}
                                        <input class="form-control" name="body" placeholder="Enter your comment..."/>
                                        <input type="hidden" name="post_id" value="{{ $post->id }}" />
                                    </div>
                                    <div class="form-group d-flex justify-content-end">
                                        <input type="submit" class="btn btn-primary btn-sm" value="Comment" />
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div >
        </div >
    @endforeach
@endsection