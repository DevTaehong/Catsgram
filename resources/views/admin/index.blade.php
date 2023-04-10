@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header d-flex">
                <div class="d-flex justify-content-start align-items-center mr-auto">
                    User Administration
                </div>
                <div class="d-flex justify-content-end">
                    <a href="/admin/users/create" class="btn btn-outline-primary" style="float: left; margin-left:20px">
                        Create New Admin User
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Roles</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $key =>$user)
                                <tr>
                                    <th scope="row">{{ $key+1 }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if(!empty($user->roles->pluck('name')))
                                            @foreach($user->roles->pluck('name') as $role)
                                                <li class="list-unstyled">
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
</div>
@endsection
