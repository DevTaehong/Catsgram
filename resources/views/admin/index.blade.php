@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">User Administration</div>
                <div class="mt-3"><a href="/admin/users/create" class="btn btn-dark" style="float: left; margin-left:20px">Create New Admin User</a></div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Roles</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $key =>$user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if(!empty($user->roles->pluck('name')))
                                        @foreach($user->roles->pluck('name') as $role)
                                            <li>
                                                <label>
                                                    {{ $role }}
                                                </label>
                                            </li>
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-success" href="/admin/users/{{$user->id}}">Show</a>
                                {{--source code: https://www.youtube.com/watch?v=4D69X8u7WDI&list=PLxFwlLOncxFLxT3ZxYPw7-hCrXhdZHg1W&index=7--}}
                                    <a class="btn btn-warning" href="{{ route('users.edit',$user->id) }}">Edit</a>


                                    <form action="/admin/users/{{ $user->id }}" method="post" style="display: inline">
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
