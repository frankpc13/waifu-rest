<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Anime extends Model
{
    //

    public function characters() {
        return $this->belongsTo(Character::class);
    }
}
