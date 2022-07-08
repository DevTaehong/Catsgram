@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Theme</div>
                    <div class="card-body">
                        <form action="/themes/{{ $theme->id }}" method="post">
                            @method('PATCH')

                            @include('theme.form')
                            <a href="/themes/" class="btn btn-danger">Cancel</a>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

