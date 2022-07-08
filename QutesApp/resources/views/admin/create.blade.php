@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add Admin User</div>

                    <div class="card-body">
                        <form action="/admin/users" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input name="name" type="text" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Enter name">
                                <small id="nameHelp" class="form-text text-muted">Enter your name. if you can remember it.</small>

                                @error('name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input name="email" type="text" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                                <small id="emailHelp" class="form-text text-muted">If you can remember your name, you should remember your email.</small>

                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input name="password" type="password" class="form-control" id="password" aria-describedby="passwordHelp" placeholder="Enter password">
                                <small id="passwordHelp" class="form-text text-muted">Enter your password.</small>

                                @error('password')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" aria-describedby="password_confirmationHelp" placeholder="Enter password">
                                <small id="password_confirmationHelp" class="form-text text-muted">Re-enter your password.</small>

                                @error('password_confirmation')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="roles">Roles</label>
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between">
                                        @foreach($roles as $role)
                                            <div class="form-check">
                                                <input class="form-check-input" name="roles[]"
                                                       type="checkbox" value="{{ $role->id }}" id="{{ $role->name }}">
                                                <lable class="form-check-label" for="{{ $role->name }}">
                                                    {{ $role->name }}
                                                </lable>
                                            </div>
                                        @endforeach
                                    </li>
                                </ul>

                                @error('roles')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <a href="/admin/users" class="btn btn-danger">Cancel</a>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
