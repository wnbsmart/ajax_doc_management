<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public function document()
    {
        return $this->hasMany('App\Document');
    }
}
