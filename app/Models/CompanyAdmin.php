<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyAdmin extends Model
{
    protected $fillable = [
        'company_id',
        'user_id',
    ];

    public function Company ()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function Users ()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }
}
