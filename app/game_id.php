<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class game_id extends Model
{
    protected $guarded = [];

    public function results(){
        return $this->hasMany(\App\result::class);
    }
}
