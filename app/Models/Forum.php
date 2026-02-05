<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $fillable = [
		'judul',
		'isi',
		'user_id',
		'is_approved',
	];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class); // pastikan Comment::class namespace benar
    }
	
	protected static function booted()
	{
		static::creating(function ($forum) {
			if (auth()->check() && auth()->user()->is_admin) {
				$forum->is_approved = true;
			}
		});
	}

}


