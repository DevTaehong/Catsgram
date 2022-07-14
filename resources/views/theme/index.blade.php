@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">Manage Themes</div>
            <div class="mt-3">
                <a href="/themes/create" class="btn btn-dark" style="float: left; margin-left:20px">Add New Theme</a>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ThemeId</th>
                            <th scope="col">Name</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($themes as $key => $theme)
                            <tr>
                                <td>{{ $theme->id }}</td>
                                <td>{{ $theme->name }}</td>
                                <td>
                                    <a class="btn btn-success" href="/themes/{{ $theme->id }}">Details</a>
                                    <a class="btn btn-warning" href="{{ route('themes.edit',$theme->id) }}">Edit</a>
                                    <form action="/themes/{{ $theme->id }}" method="post" style="display: inline">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
