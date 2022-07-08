<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Post extends Model
{
    protected  $guarded = [];

    use Notifiable;
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function path()
    {
        return url('/posts/' . $this->id);
    }


}
