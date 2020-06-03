<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Character extends Model
{
    protected $collection = "characters";
    protected $fillable = ['name', 'image', 'birthdate', 'isActive'];

    public function anime() {
        return $this->belongsTo(Anime::class);
    }
}
