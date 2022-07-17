<div class="form-group">
    <label for="title">Post Title</label>
    <input name="title" type="text" class="form-control" id="title" aria-describedby="titleHelp" value="{{ old('title') ?? $post->title }}" autocomplete="off">

    @error('title')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="content">Content</label>
    <input name="content" type="text" class="form-control" id="content" aria-describedby="contentHelp" value="{{ old('content') ?? $post->content }}" autocomplete="off">

    @error('content')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="image">Image</label>
    <input name="image" type="file" accept="image/*" class="form-control" id="image" aria-describedby="imageHelp" value="{{ old('image') ?? $post->image }}" autocomplete="off">
    @error('image')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

@csrf
