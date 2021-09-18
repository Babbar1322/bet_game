<?php

use Illuminate\Database\Seeder;
use App\betNo;
class betnumSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $no = [
            [
               'color_id'=>2,
               'number'=> 0
            ],
            [
               'color_id'=>1,
               'number'=> 1
            ],
            [
               'color_id'=>3,
               'number'=> 2
            ],
            [
               'color_id'=>1,
               'number'=> 3
            ],
            [
               'color_id'=>3,
               'number'=> 4
            ],
            [
               'color_id'=>2,
               'number'=> 5
            ],
            [
               'color_id'=>3,
               'number'=> 6
            ],
            [
               'color_id'=>1,
               'number'=> 7
            ],
            [
               'color_id'=>3,
               'number'=> 8
            ],
            [
               'color_id'=>1,
               'number'=> 9
            ],
           
           
        ];
  
        foreach ($no as $key => $value) {
            betNo::create($value);
        }
    }
}
