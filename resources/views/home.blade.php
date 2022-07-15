@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Welcome to the Quotes App!</div>
                @if(\Illuminate\Support\Facades\Auth::check())
                    <div class="mt-3">
                        <a href="posts/create" class="btn btn-dark" style="float: left; margin-left:20px">
                            Create New Post
                        </a>
                    </div>
                @endif
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach($posts as $post)
                        <div class="card m-3">
                            <div class="card-header">{{ $post->title }}</div>
                            @if($post->image != null)
                                <img class="m-3" src="{{url('/images')}}/{{ $post->image }}" alt="Image" width="500"/>
                            @endif

                            @foreach($users as $user)
                                @if($user->id == $post->created_by)
                                    <div class="m-3"><strong>{{ $user->name }}</strong> {{ $post->content }}</div>
                                @endif
                            @endforeach
                            <small class="ml-3">{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</small>
{{--                            Comments --}}

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
                                            <input type="submit" class="btn btn-success" value="Add Comment" />
                                        </div>
                                    </div>
                                </form>
                            @endif
{{--                            Buttons for the posts--}}
                            <div class="d-flex justify-content-center mb-3">
                                @if($post->created_by == $id)
                                    <a class="btn btn-warning" href="{{ route('posts.edit',$post->id) }}">Edit</a>
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
                    @endforeach
                </div>
            </div>


        </div>
    </div>
</div>
@endsection
