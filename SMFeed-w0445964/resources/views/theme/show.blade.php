@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">Theme Details for {{ $theme->name }}</div>
                <div class="card-body">
                    <strong>Name</strong>
                    <p>{{ $theme->name }}</p>

                    <strong>CDN Url</strong>
                    <p>{{ $theme->cdn_url }}</p>


                    <a class="btn btn-primary" href="/themes">Back to Themes</a>
                    <a class="btn btn-warning" href="{{ route('themes.edit',$theme->id) }}">Edit</a>
                    <form action="/themes/{{ $theme->id }}" method="post" style="display: inline">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
