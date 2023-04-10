@extends('layouts.app')

@section('content')
@if(\Illuminate\Support\Facades\Auth::check())
    <div id="example"></div>
@endif 
@foreach($posts as $post)
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="rounded-4 card shadow-sm ">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach($users as $user)
                        @if($user->id == $post->created_by)
                            <div class="mt-3 ml-3 d-flex flex-start align-items-center">
                                <div>
                                    <img class="rounded-circle shadow-1-strong me-3"
                                        src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp" alt="avatar" width="40" height="40" 
                                    />
                                </div>
                                <div class="d-flex flex-column">
                                    <strong class="ml-2 mr-1 font-weight-bold">{{ $user->name }}</strong>
                                    <small class="ml-2 text-secondary">{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</small>
                                </div>    
                            </div>
                        @endif
                    @endforeach
                    
                    <div class="mt-1 ml-3 mb-1">{{ $post->content }}</div>
                    @if($post->image != null)
                        <img style="width: 100%; max-width: 100%; height: auto;"
                            class="responsive" src="store_image/fetch_image/{{$post->id}}"/>
                    @endif
                    {{--Comments --}}
                    <div class="col-md">
                        <hr />
                        <h5>Display Comments</h5>
                    </div>
                    @include('post.commentsDisplay',
                        ['comments' => $post->comments, 'post_id' => $post->id,
                        'post_created_by' => $post->created_by, 'id' => $id])
                    <div class="col-md">
                        <hr />
                    </div>
                    @if(Auth::user())
                        <h5 class="col-md">Add comment</h5>
                        <form method="post" action="{{ route('comments.store') }}">
                            @csrf
                            <div class="col-md">
                                <div class="form-group">
                                    <textarea class="form-control" name="body"></textarea>
                                    <input type="hidden" name="post_id" value="{{ $post->id }}" />
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Add Comment" />
                                </div>
                            </div>
                        </form>
                    @endif
                    {{-- Buttons for the posts --}}
                    <div class="d-flex justify-content-center mb-3">
                        @if($post->created_by == $id)
                            <a class="btn btn-outline-primary mr-1" href="{{ route('posts.edit',$post->id) }}">Edit</a>
                        @endif
                        @if($post->created_by == $id or
                            implode(', ', $moderatorId->pluck('id')->toArray()) ==
                            (implode(', ', $roleId->pluck('role_id')->toArray())))
                            <form action="/posts/{{ $post->id }}" method="post" style="display: inline">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div >
    </div >
@endforeach
@endsection
