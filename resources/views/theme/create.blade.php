@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create new Theme</div>

                    <div class="card-body">
                        <form action="/themes" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input name="name" type="text" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Enter name">

                                @error('name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cdn_url">CDN Url</label>
                                <input name="cdn_url" type="text" class="form-control" id="cdn_url" aria-describedby="cdn_urlHelp" placeholder="Enter the CDN url">

                                @error('cdn_url')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <a href="/themes" class="btn btn-danger">Cancel</a>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
