<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class betNo extends Model
{
    public function bet_colors(){
        return $this->hasMany(\App\bet_color::class);
      }
}
