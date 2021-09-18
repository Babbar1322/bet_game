<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bet_color extends Model
{
   public function betNos(){
     return $this->hasMany(\App\betNo::class);
   }
}
