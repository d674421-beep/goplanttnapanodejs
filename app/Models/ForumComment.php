<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumComment extends Model {
    public function replies() {
        return $this->hasMany(self::class, 'parent_id');
    }
}

