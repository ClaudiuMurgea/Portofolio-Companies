<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = ['url'];

    public function Banner ()
    {
        return $this->hasOne(Banner::class, 'media_id', 'id');
    }
}
