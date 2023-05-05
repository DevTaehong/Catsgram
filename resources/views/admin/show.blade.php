@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">User Details</div>
                <div class="card-body">
                    <strong>Name</strong>
                    <p>{{ $user->name }}</p>

                    <strong>Email</strong>
                    <p>{{ $user->email }}</p>

                    @if(!empty($user->roles->pluck('name')))
                        <strong>Current Roles</strong>
                        @foreach($user->roles->pluck('name') as $role)
                            <li class="list-unstyled">
                                {{ $role }}
                            </li>
                        @endforeach
                    @endif
                    <div class="mt-3">
                        <a class="btn btn-outline-primary" href="/admin/users">Back to Users List</a>
                        <a class="btn btn-outline-secondary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                        <form action="/admin/users/{{ $user->id }}}}" method="post" style="display: inline">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
