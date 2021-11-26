<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class CompanyProfile extends Model
{
    protected $fillable = ['company_id', 'address', 'city', 'zip', 'state_id', 'phone', 'color', 'logo'];

    public function State ()
    {
        return $this->hasOne(State::class, 'id', 'state_id');
    }

    public function Media ()
    {
        return $this->hasOne(Media::class, 'id', 'logo');
    }
}
