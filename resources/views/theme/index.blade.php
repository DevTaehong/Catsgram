@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header d-flex">
                <div class="d-flex justify-content-start align-items-center mr-auto">
                    Manage Themes
                </div>
                <div class="d-flex justify-content-end">
                    <a href="/themes/create" class="btn btn-dark" style="float: left; margin-left:20px">Add New Theme</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Theme's Id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($themes as $key => $theme)
                                <tr>
                                    <td>{{ $theme->id }}</td>
                                    <td>{{ $theme->name }}</td>
                                    <td>
                                        <a class="btn btn-outline-primary" href="/themes/{{ $theme->id }}">Details</a>
                                        <a class="btn btn-outline-secondary" href="{{ route('themes.edit',$theme->id) }}">Edit</a>
                                        <form action="/themes/{{ $theme->id }}" method="post" style="display: inline">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger">Delete</button>
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
</div>
@endsection
