@foreach($comments as $comment)
    <div class="col-md">
        <div class="display-comment">
            <p style="margin-bottom: 0em"><strong>{{ $comment->user->name }} </strong>{{ $comment->body }}</p>
            <small class="mt-1">
                {{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}
            </small>
            @if(Auth::user())
            <a href="" id="reply"></a>
            <form method="post" action="{{ route('comments.store') }}">
                @csrf
                <div class="form-group">
                    <input type="text" name="body" class="form-control" />
                    <input type="hidden" name="post_id" value="{{ $post_id }}" />
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
                </div>
                    <input type="submit" class="btn btn-warning" value="Reply" />
            </form>
            @if($comment->user_id == $id)
                <form action="/comments/{{ $comment->id }}" method="post">
                    @method('DELETE')
                    @csrf
                    <input type="submit" class="btn btn-danger" value="Delete" />
                </form>
            @endif
            @include('post.commentsDisplay', ['comments' => $comment->replies])
            @endif
        </div>
    </div>
@endforeach
