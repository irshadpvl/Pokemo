<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pokemon extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    protected $table = "pokemon";

    public function sprites()
    {

        return $this->hasMany(Sprite::class);
    }
}
