<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class result extends Model
{
   protected $guarded = [];

   public function game_ids(){
      return $this->hasOne(\App\game_id::class);
   }
}
