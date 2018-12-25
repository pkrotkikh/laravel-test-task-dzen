<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'email', 'homepage', 'text','file'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'remember_token',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getShowFileAttribute()
    {
        if ($this->file) {
            return '/uploads/' . $this->file;
        }
    }
}
