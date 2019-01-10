<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailUser extends Model
{
    protected $guarded = [];

    public function religion()
    {
        return $this->hasOne('App\Models\Religion', 'id', 'religion_id');
    }

}
