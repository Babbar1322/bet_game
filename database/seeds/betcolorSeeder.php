<?php

use Illuminate\Database\Seeder;
use App\bet_color;

class betcolorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $color = [
            [
               'name'=>'Green',
            ],
            [
               'name'=>'Purple',
            ],
            [
               'name'=>'Red',
            ],
           
        ];
  
        foreach ($color as $key => $value) {
            bet_color::create($value);
        }
    }
}
