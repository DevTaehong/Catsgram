@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit User</div>
                    <div class="card-body">
                        <form action="/admin/users/{{ $user->id }}" method="post">

                            @method('PATCH')

                            @include('admin.form')
                            <a href="/admin/users/" class="btn btn-danger">Cancel</a>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

