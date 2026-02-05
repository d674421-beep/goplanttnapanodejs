<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encyclopedia extends Model
{
    use HasFactory;

    protected $table = 'encyclopedias';

    protected $fillable = [
		'title',
		'content',
		'plant_id',
		'image',
		'video_url',
		'created_by',
	];




    // Relasi: ensiklopedia dibuat oleh user (admin)
	public function plant()
	{
		return $this->belongsTo(Plant::class);
	}

	public function author()
	{
		return $this->belongsTo(User::class, 'created_by');
	}

}
