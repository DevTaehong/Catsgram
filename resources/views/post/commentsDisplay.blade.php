<link rel="stylesheet" href="{{ URL::asset('css/comments.css') }}">
@foreach($comments as $comment)
    <div class="col-md">
        <div class="display-comment">
            <div class="d-flex flex-row">
                {{-- <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp" width="40" height="40" 
                    class="rounded-circle mr-1" alt="Profile Image"
                /> --}}
                <div class="d-flex flex-column">
                    <div class="w-100 bg-light p-2 rounded-lg">
                        <div class="d-flex align-items-center">
                            <span class="font-weight-bolder">{{ $comment->user->name }}</span>
                        </div>
                        <p class="text-justify comment-text mb-0">
                            {{ $comment->body }}
                        </p>
                    </div>
                    <div class="d-flex flex-row justify-content-between">
                        @if(Auth::user())
                            <button type="button" class="d-flex flex-row btn btn-link p-0 text-dark border-0" data-toggle="collapse" 
                                data-target="#multiCollapse{{ $comment->id }}" aria-expanded="false" aria-controls="multiCollapse{{ $comment->id }}"
                            >
                                Reply
                            </button>
                            @if($comment->user_id == $id)
                                <form action="/comments/{{ $comment->id }}" method="post"">
                                    @method('DELETE')
                                    @csrf
                                    <input type="submit" class="btn btn-link text-dark pt-0 border-0" value="Delete"/>
                                </form>
                            @endif
                        @endif
                        <div class="d-flex flex-row text-dark">
                            {{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans(null, \Carbon\CarbonInterface::DIFF_ABSOLUTE, true) }}
                        </div>
                    </div>

                    {{-- After a user clicks the Reply button--}}
                    <div class="collapse multi-collapse" id="multiCollapse{{ $comment->id }}">
                        <form method="post" action="{{ route('comments.store') }}">
                            @csrf
                            <div class="form-group d-flex flex-row align-items-center" >
                                {{-- <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp" width="30" height="30" 
                                    class="rounded-circle mr-1" alt="Profile Image"
                                /> --}}
                                <div class="d-flex flex-row">
                                    <input type="text" name="body" class="form-control" placeholder="Enter your comment..." />
                                    <button class="btn btn-link btn-sm" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                                            <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z"/>
                                        </svg>
                                    </button>
                                </div>
                                <input type="hidden" name="post_id" value="{{ $post_id }}" />
                                <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
                            </div>
                        </form>
                    </div>
                    @include('post.commentsDisplay', ['comments' => $comment->replies])
                </div>
            </div>
        </div>
    </div>
@endforeach
