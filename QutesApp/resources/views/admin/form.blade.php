<div class="form-group">
    <label for="name">Name</label>
    <input name="name" type="text" class="form-control" id="name" aria-describedby="nameHelp" value="{{ old('name') ?? $user->name }}" autocomplete="off">
    <small id="nameHelp" class="form-text text-muted">Enter your name. if you can remember it.</small>

    @error('name')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="email">Email address</label>
    <input name="email" type="text" class="form-control" id="email" aria-describedby="emailHelp" value="{{ old('name') ?? $user->email }}" autocomplete="off">
    <small id="emailHelp" class="form-text text-muted">If you can remember your name, you should remember your email.</small>

    @error('email')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

{{--Source: https://www.youtube.com/watch?v=p5ncbfc5Cr0&list=PLxFwlLOncxFLxT3ZxYPw7-hCrXhdZHg1W&index=10--}}
<div class="mb-3">
    <label for="roles">Roles</label>
    <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between">
            @foreach($roles as $role)
                <div class="form-check">
                    <input class="form-check-input" name="roles[]"
                           type="checkbox" value="{{ $role->id }}" id="{{ $role->name }}"
                        @isset($user) @if(in_array($role->id, $user->roles->pluck('id')->toArray())) checked @endif @endisset>
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

@csrf
