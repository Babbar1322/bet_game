<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\timer;
use App\bet_color;
use App\betNo;
use App\game;
use App\wallet;
use App\User;
use App\result;
use App\game_id;
use DB;
use App\winner;
use App\amountPer;


class timeStore extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'time:store';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store Time every five minutes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        timer::create([
            'start_time'=>round(microtime(true)*1000), 
            'end_time'=> round(microtime(true)*1000 + 60000 * 6)
        ]);
        $cnt = game_id::count();
        if($cnt == 0){
            game_id::create([
                "game_id"=>date("Ymd")."001"
            ]);
        } else{
            $con = game_id::where("game_id",date("Ymd")."001")->first();
            if(!$con){
                game_id::create([
                    "game_id"=>date("Ymd")."001"
                ]);
            }
        }
        $last_id = game_id::orderBy("id","desc")->first();
        if($last_id ){

            $gme = game_id::where("game_id",$last_id->game_id)->update([
                "expire"=>1
            ]);
               $game = game_id::create([
                    "game_id"=>$last_id->game_id+1
                ]);
        }

        $last_id = game_id::where("expire",1)->orderBy("id","desc")->first();
        $win = winner::where('status',1)->where("game_id",$last_id->id)->orderBy("id","desc")->first();
        $pers = amountPer::first();
        if(!$pers){
            $per = 2;
        }
        else {
            $per = $pers->percentage;
        }
            $colorno = array(1=>'Green',2=>'Red',3=>'Green',4=>'Red',6=>'Red',7=>'Green',8=>'Red',9=>'Green');
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
               $result = result::create([
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
                 $result = result::create([
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
               $result = result::create([
                    "game_id"=>$last_id->id,
                    "number"=> $rand,
                    "price"=>0,
                    "result"=>$getcolor
                ]);
                \Log::info($result);
                return response()->json(["Others",$getcolor],200);


            }
      
    }
}
