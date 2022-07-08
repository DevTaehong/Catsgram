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

                    <strong>Current Roles:</strong>
                    @if(!empty($user->roles->pluck('name')))
                        @foreach($user->roles->pluck('name') as $role)
                            <li>
                                <p>
                                    {{ $role }}
                                </p>
                            </li>
                        @endforeach
                    @endif
                    <a class="btn btn-primary" href="/admin/users">Back to Users List</a>
                    <a class="btn btn-warning" href="{{ route('users.edit',$user->id) }}">Edit</a>
                    <form action="/admin/users/{{ $user->id }}}}" method="post" style="display: inline">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
