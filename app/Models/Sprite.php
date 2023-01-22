<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sprite extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = "sprites";
    protected $guarded = [];

    public function pokemon()
    {
        return $this->belongsTo(Pokemon::class);
    }
}
