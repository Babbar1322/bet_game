<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\game;
use App\game_id;
use App\result;
use DB;
use App\winner;
use App\User;
use Illuminate\Pagination\Paginator;


class GameController extends Controller
{
    public function store(Request $request){
        if($request->minute >0 || $request->second >=16){
            $arr = ["Red","Green","Violet"];
            if(in_array($request->colnum,$arr)){
                $type = "color";
            }
            else{
                $type="number";
            }
            $last_id = game_id::where("expire",0)->orderBy('id',"desc")->first();
            $count = game_id::where("expire",0)->count();
            $cg = game::where("colnum","Green")->where('user_id',$request->user_id)->where("game_id",$last_id->id)->count();
            $cr = game::where("colnum","Red")->where('user_id',$request->user_id)->where("game_id",$last_id->id)->count();
            $con = game::where('user_id',$request->user_id)->orderBy('id','desc')->where("game_id",$last_id->id)->first();
            $total = game::where("game_id",$last_id->id)->where("user_id",$request->user_id)->count();
            if($total < 7){
                // if($count > 0 ){
                //     if($cg>0 && $request->colnum =="Red"){
                //         return response()->json(["error"=>'you are not allowed to use '.$request->colnum.' color. Please read game rule carefully'],401);
                //     }
                //     elseif($cr>0 && $request->colnum =="Green"){
                //         return response()->json(["error"=>'you are not allowed to use '.$request->colnum.' color. Please read game rule carefully'],401);
                //     }
                //     else{
                //         game::create([
                //             'user_id'=> $request->user_id,
                //             'game_id'=> $last_id->id,
                //             "betType"=>$type,
                //             'amount'=> $request->amount,
                //             'colnum'=> $request->colnum,
                //             'time'=> $request->time
                //         ]);
                //         return response()->json(200);
                //     }
                // }
                // else{
                game::create([
                    'user_id'=> $request->user_id,
                    'amount'=> $request->amount,
                    "betType"=>$type,
                    'colnum'=> $request->colnum,
                    'time'=> $request->time,
                    'game_id'=> $last_id->id,
                ]);
                return response()->json(200);
                // }
            }
            else{
                return response()->json(["error"=>"Please Read rules carefully . next time your account will be freezed"],401);

            }
        }
        else{
            return response()->json(["error"=>"time is over"],401);
        }
    }
    public function result(){
        $game = game::orderBy("time",'desc')->get();
        return response()->json(compact("game"));
    }
    public function getid(){
        $game = game_id::orderBy('id','desc')->first();
        return response()->json($game);
    }

    public function getRecord(){
        $records = game::distinct()->orderBy("id","desc")->get(["game_id"])->map(function($data){
            // $clr = game::where("game_id",$data->game_id)->distinct()->get(["colnum","betType"]);
            // $colors = [];
            // $amount = [];
            // $type = [];
            // foreach($clr as $colr){
            //         $type[] = $colr->betType;
            //         $colors[]= $colr->colnum;
            //         $amount[] = game::where("colnum",$colr->colnum)->where("game_id",$data->game_id)->sum("amount");
            // }
            $data->id = $data->game_id;
            $game = game::where("game_id",$data->game_id)->sum("profit");
            $game_id = game_id::where("id",$data->game_id)->first();
            // $data->colors = $colors;
            $data->game_id = $game_id->game_id;
            $data->profit = $game;
           
            // $data->amount = $amount;
            // $data->type = $type;
            return $data;
        });
        $records =  new Paginator($records,10);
        return view("admin.betRecord",compact("records"));
    }
    public function getBet(Request $request){
        $colors = game::where('game_id',$request->id)->distinct()->orderBy("id","desc")->get(['colnum','betType','user_id'])->map(function($data){
            $amount = game::where("colnum",$data->colnum)->where("game_id",Request()->id)->where('user_id',$data->user_id)->sum("amount");
            $user = User::where("id",$data->user_id)->first();
            $profit = game::where("colnum",$data->colnum)->where("game_id",Request()->id)->where("user_id",$data->user_id)->sum("profit");
            $data->amount = $amount;
            $data->phone = $user->phone;
            $data->profit = $profit;
            return $data;
        });
        // $users = game::where('game_id',$request->game_id)->orderBy("id","desc")->get();
        // $user = [];
        // foreach($users as $usr){
        //     $user[] = $usr->user_id;
        // }
        // return response()->json(compact('color'));
        return view('admin.betRecordsDetail',compact('colors'));
    }

    public function liveStatus(){
        $games = game::join("game_ids","games.game_id","game_ids.id")->where("game_ids.expire",0)->get();
        $qbets = DB::select("SELECT SUM(amount) as smamount, colnum FROM `games` inner join `game_ids` on games.game_id = game_ids.id where game_ids.expire=0 GROUP BY games.betType,games.colnum");
        $colors = array('Green'=>0,'Red'=>0,'Violet'=>0);
        $numbers = array('0'=>0,'1'=>0,'2'=>0,'3'=>0,'4'=>0,'5'=>0,'6'=>0,'7'=>0,'8'=>0,'9'=>0);
     foreach($qbets as $bet){
         $color = $bet->colnum;
        $colors[$color] = $bet->smamount;
        $number = $bet->colnum;
        $numbers[$number] = $bet->smamount;
     }
     $game_id = game_id::where("expire",0)->orderBy("id","desc")->first();
      
        return view('admin.gameStatus',compact('games','colors','numbers','game_id'));
    }


    public function winner(Request $request){
        $this->validate($request,[
            "result"=>"required"
        ]);
        winner::create([
            "result"=>$request->result,
            "game_id"=>$request->game_id,
            "status"=>1
        ]);
        return redirect()->back()->with(["message","Result Declared successfully"]);
    }
}
