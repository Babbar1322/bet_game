<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\bet_color;
use App\betNo;
use App\game;
use App\wallet;
use App\User;
use App\result;
use App\game_id;
use App\timer;
use DB;
use App\winner;
use App\amountPer;

// use App\timer;


class ResultController extends Controller
{
    public function store(Request $request){
        
        $data = $this->manualGame($request);
        return response($data);
            // $odd_no = array(1,3,7,9);
            // $even_no = array(2,4,6,8);
            // $rand = mt_rand(0, 9);
            // $arr = ["Red","Green","Violet"];
            // $val = array_rand($arr);
            // // $game_id = game_id::orderBy("id","desc")->first();
            // $colors = bet_color::get();
            // $clr = [];
            // foreach($colors as $colr){
            //     $clr[] = $colr->id; 
            // }
            // // $betNo = betNo::where("number",$colnum)->first();
            // // $colorId = bet_color::where("id",$betNo->color_id)->first();
            // // $colnum = game::where("game_id",$game_id)->where("colnum",$rand)->first();
            // $colnum = betNo::whereIn("color_id",$clr)->where("number",$rand)->first();
            // $color = bet_color::where("id",$colnum->color_id)->first();
            // // if($color && $color->name){
            // //     }
            // //     else{
            // //     }
            
            // $game = game::where('game_id',$last_id->id)->where("colnum",$colnum->number)->first();
            // if($game){ 
            //     $users = game::where('game_id',$last_id->id)->where("colnum",$colnum->number)->get();
            //     $color = bet_color::where("id",$game->colnum)->first();
            //     $amount = game::where("game_id",$last_id->id)->where("colnum",$game->colnum)->sum("amount");
            // }
            // else{
            //     // $colnum = betNo::whereIn("color_id",$clr)->where("number",$rand)->first();
            //     $users = game::where("game_id",$last_id->id)->where("colnum",$color->name)->get();

            //     $color = bet_color::where("id",$colnum->color_id)->first();
            //     $amount = game::where("game_id",$last_id->id)->where("colnum",$color->name)->sum("amount");
            // }

            //     $am = $amount-($per/100 * $amount);
            //     if(!$game && $color->name){
            //     if(in_array($rand,$odd_no) && $color->name == "Green"){
            //         $balance = $am * 2;
            //     }
            //     elseif($rand == 5 && $color->name == "Green"){
            //         $balance = $am*1.5;
            //     }
            //     elseif(in_array($rand,$even_no) && $color->name == "Red"){
            //         $balance = $am * 2;
            //     }
            //     elseif($rand == 0 && $color->name == "Red"){
            //         $balance = $am*1.5;
            //     }
            //     elseif(($rand == 5 && $color->name == "Violet") ||($rand == 0 && $color->name == "Violet")){
            //         $balance = $am*4.5;
            //     }
            // }
            //     elseif($colnum->number == $rand){
            //         $balance = $am*9;
            //     }
            //     if($balance > 0){
            //     for($i=0;$i<count($users);$i++){
            //         $usr = User::where("id",$users[$i]['user_id'])->first();
            //          $wallet = new wallet();
            //          $wallet->credit = 1;
            //          $wallet->balance = $balance;
            //          $wallet->user_id = $usr->id;
            //          $wallet->user_name = $usr->name;
            //          $wallet->save();
            //          game::where('user_id',$usr->id)->where("game_id",$last_id->id)->update([
            //              "profit"=>$balance,
            //              "status"=>1
            //          ]);
            //          game::where('user_id',"!=",$usr->id)->where("game_id",$last_id->id)->update([
            //              "status"=>2
            //          ]);
            //         }
            //     }
               
                
            //     $res = result::where("game_id",$last_id->id)->first();
            //     if(!$res){
            //         $result = new result();
            //         $result->game_id = $last_id->id;
            //         $result->number = $rand;
            //         $result->price=0;
            //         $result->result = $arr[$val];
            //         // if(!$game){
            //         // $result->result = $color->name;
            //         // }
            //         // else{
            //         //     $colr = betNo::where("number",$colnum->number)->first();
            //         //     $colrname = bet_color::where("id",$colr->color_id)->first();
            //         //     $result->result = $colrname->name;

            //         // }
            //         $result->save();
            //         return response()->json(200);
            //     }
            //     else{
            //             return response()->json("error");
            //     }
        // }
        // else{
        //     return response()->json(["error"=>"result already decarlard, wait for next result"],401);

        // }
    
}

public function manualGame($request){
    timer::create([
        'start_time'=>round(microtime(true)*1000), 
        'end_time'=> round(microtime(true)*1000 + 60000 * 1)
    ]);
    $cnt = game_id::count();
        if($cnt == 0){
            game_id::create([
                "game_id"=>date("Ymd")."001"
            ]);
        }
        else{
            $con = game_id::where("game_id",date("Ymd")."001")->first();
            if(!$con){
                game_id::create([
                    "game_id"=>date("Ymd")."001"
                ]);
            }
        }
        $last_id = game_id::orderBy("id","desc")->first();
        if($last_id && $request->minute <= 0 && $request->second <=15){
            $gme = game_id::where("game_id",$last_id->game_id)->update([
                "expire"=>1
            ]);
               $game = game_id::create([
                    "game_id"=>$last_id->game_id+1
                ]);
          
         
        }
        $last_id = game_id::where("expire",1)->orderBy("id","desc")->first();
        if($request->minute <= 0 || $request->second <= 15){  
            $win = winner::where('status',1)->where("game_id",$last_id->id)->orderBy("id","desc")->first();
            $colorno = array(1=>'Green',2=>'Red',3=>'Green',4=>'Red',6=>'Red',7=>'Green',8=>'Red',9=>'Green');
            $pers = amountPer::first();
            if(!$pers){
                $per = 2;
            }
            else {
                $per = $pers->percentage;
            }
            if($win){
                $rand = $win->result;
            }
            else{
                $rand = mt_rand(0, 9);
            }
            if($rand == 0){
               $game = game::where("betType","color")->where("colnum", "Violet")->where("game_id",$last_id->id)->get();
               foreach($game as $gm){
                $balance = $gm->amount-($per/100*$gm->amount);
                  game::where("game_id",$last_id->id)->where("colnum",$gm->colnum)->update([
                      "status"=>1,
                      "profit"=> $balance * 4.5
                  ]);
                  game::where("game_id",$last_id->id)->where("colnum","!=",$gm->colnum)->update([
                      "status"=>2,
                      
                  ]);
                  $wallet = new wallet();
                  $wallet->user_id = $gm->user_id;
                  $wallet->credit = 1;
                  $wallet->balance = $balance * 4.5;
                  $wallet->save();
               
                }
                $game = game::where("betType","color")->where("colnum", "Red")->where("game_id",$last_id->id)->get();
                foreach($game as $gm){
                    $balance = $gm->amount-($per/100*$gm->amount);
                   game::where("game_id",$last_id->id)->where("colnum",$gm->colnum)->update([
                       "status"=>1,
                       "profit"=> $balance * 1.5
                   ]);
                   game::where("game_id",$last_id->id)->where("colnum","!=",$gm->colnum)->update([
                    "status"=>2,
                ]);
               }
               result::create([
                "game_id"=>$last_id->id,
                "number"=> $rand,
                "price"=>0,
                "result"=>"Red,Violet"
            ]);
            
                return response()->json("VioletRed",200);


            }elseif($rand == 5){
                $game = game::where("betType","color")->where("colnum", "Violet")->where("game_id",$last_id->id)->get();
                foreach($game as $gm){
                    $balance = $gm->amount-($per/100*$gm->amount);
                   game::where("game_id",$last_id->id)->where("colnum",$gm->colnum)->update([
                       "status"=>1,
                       "profit"=> $balance * 4.5
                   ]);
                   game::where("game_id",$last_id->id)->where("colnum","!=",$gm->colnum)->update([
                    "status"=>2,
                ]);
                   $wallet = new wallet();
                  $wallet->user_id = $gm->user_id;
                  $wallet->credit = 1;
                  $wallet->balance = $balance * 4.5;
                  $wallet->save();
                
                 }
                $game = game::where("betType","color")->where("colnum", "Green")->where("game_id",$last_id->id)->get();
                foreach($game as $gm){
                    $balance = $gm->amount-($per/100*$gm->amount);
                   game::where("game_id",$last_id->id)->where("colnum",$gm->colnum)->update([
                       "status"=>1,
                       "profit"=> $balance * 1.5
                   ]);
                   game::where("game_id",$last_id->id)->where("colnum","!=",$gm->colnum)->update([
                    "status"=>2,
                ]);
                    $wallet = new wallet();
                  $wallet->user_id = $gm->user_id;
                  $wallet->credit = 1;
                  $wallet->balance = $balance * 1.5;
                  $wallet->save();
                 }
                 result::create([
                    "game_id"=>$last_id->id,
                    "number"=> $rand,
                    "price"=>0,
                    "result"=>"Green,Violet"
                ]);
                return response()->json("GreenViolet",200);

            }else{
                $getcolor = $colorno[$rand];
                $game = game::where("betType","number")->where("colnum", $rand)->where("game_id",$last_id->id)->get();
                foreach($game as $gm){
                    $balance = $gm->amount-($per/100*$gm->amount);
                    game::where("game_id",$last_id->id)->where("colnum",$gm->colnum)->update([
                        "status"=>1,
                        "profit"=> $balance * 9
                    ]);
                    game::where("game_id",$last_id->id)->where("colnum","!=",$gm->colnum)->update([
                        "status"=>2,
                    ]);
                    $wallet = new wallet();
                  $wallet->user_id = $gm->user_id;
                  $wallet->credit = 1;
                  $wallet->balance = $balance * 9;
                  $wallet->save();
                }
                $game = game::where("betType","color")->where("colnum", $getcolor)->where("game_id",$last_id->id)->get();
                foreach($game as $gm){
                    $balance = $gm->amount-($per/100*$gm->amount);
                    game::where("game_id",$last_id->id)->where("colnum",$gm->colnum)->update([
                        "status"=>1,
                        "profit"=> $balance * 2
                    ]);
                    game::where("game_id",$last_id->id)->where("colnum","!=",$gm->colnum)->update([
                        "status"=>2,
                    ]);
                    $wallet = new wallet();
                    $wallet->user_id = $gm->user_id;
                    $wallet->credit = 1;
                    $wallet->balance = $balance *2;
                    $wallet->save();
                }
                result::create([
                    "game_id"=>$last_id->id,
                    "number"=> $rand,
                    "price"=>0,
                    "result"=>$getcolor
                ]);
                return response()->json(["Others",$getcolor],200);


            }
        }
}

    public function get(){
        $result = result::join("game_ids","results.game_id","game_ids.id")->orderBy("results.id","desc")->get(["game_ids.game_id","results.number","results.price","results.result"])->map(function($data)
         {  
             $data->game_id = $data->game_id;
             $data->number = $data->number;
             $data->price = $data->price;
             $data->result = explode(",",$data->result);
             
             return $data;
        });
        return response()->json($result);
     
    }

    public function playShow(){
        return view('admin.play');
    }

    public function play(Request $request){
        $this->manualGame($request);
        return redirect()->route('admin.playShow')->with("message","New Game started.Play!");
    }


   
}
