@foreach($comments as $comment)
    <div class="col-md">
        <div class="display-comment" @if($comment->parent_id != null) style="margin-left:40px;" @endif>
            <p><strong>{{ $comment->user->name }} </strong>{{ $comment->body }}</p>
            <a href="" id="reply"></a>
            <form method="post" action="{{ route('comments.store') }}">
                @csrf
                <div class="form-group">
                    <input type="text" name="body" class="form-control" />
                    <input type="hidden" name="post_id" value="{{ $post_id }}" />
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-warning" value="Reply" />
                </div>

                <hr />
            </form>
            @include('post.commentsDisplay', ['comments' => $comment->replies])
        </div>
    </div>
@endforeach
