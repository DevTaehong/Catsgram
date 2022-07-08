<div class="form-group">
    <label for="name">Name</label>
    <input name="name" type="text" class="form-control" id="name" aria-describedby="nameHelp" value="{{ old('name') ?? $theme->name }}" autocomplete="off">

    @error('name')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="cdn_url">CDN Url</label>
    <input name="cdn_url" type="text" class="form-control" id="cdn_url" aria-describedby="cdn_urlHelp" value="{{ old('name') ?? $theme->cdn_url }}" autocomplete="off">

    @error('cdn_url')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

@csrf
