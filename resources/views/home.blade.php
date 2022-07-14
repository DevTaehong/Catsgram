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

                    <ul class="list-group">
                        @foreach($posts as $post)
                            <li class="list-group-item">
                                @foreach($users as $user)
                                    @if($user->id == $post->created_by)
                                        <h7>Posted by {{ $user->name }} on {{ $post->created_at->format("D M. d, Y H:i") }}</h7>
                                    @endif
                                @endforeach
                                <h4>{{ $post->title }}</h4>
                                <div class="mt-2">
                                    <p>
                                        {{ $post->content }}
                                    </p>
                                </div>
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
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection
