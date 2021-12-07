<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Theme extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected  $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
