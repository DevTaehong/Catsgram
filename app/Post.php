<?php

namespace App;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Post extends Model
{
    protected  $guarded = [];

    use Notifiable;
    use SoftDeletes;
    protected $fillable = ['title','content','image','created_by'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function path()
    {
        return url('/posts/' . $this->id);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

}
