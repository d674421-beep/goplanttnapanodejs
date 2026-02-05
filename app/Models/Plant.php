<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    

    protected $table = 'plants'; // opsional, tapi aman

    protected $fillable = [
        'name',
        'description',
        'category',
    ];
	public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }

}
