<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use Hash;
use App\game;
use App\game_id;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\JWTManager as JWT;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Auth;
use App\wallet;
use Illuminate\Support\Str;
use App\level;
use App\payment;
use App\IncomeWallet;
use App\withdraw;
use App\result;

class UserController extends Controller
{
    public function register(Request $request){
    
        $validator = Validator::make($request->all(), [
                'phone' => 'required|string|',
                'password' => 'required|string|min:6',
            ]);

            if($validator->fails()){
                return response()->json($validator->errors(), 400);
            }
          $usr = User::where('is_admin','!=',1)->first();
          $admin = User::where('is_admin',1)->first('UID'); 
          $valid= User::where('UID',$request->sid)->first();
          $validPhn = User::where('phone',$request->phone)->first();
          if($validPhn){
            return response()->json(['error'=>"User already exist"] ,400);
          }
          if(!$usr || !$request->sid){
              $sid =  $admin->UID;
          }
          else{
              if(!$valid){
                  return response()->json(['error'=>"invalid invitation code"] ,400);
              }
              $sid = $request->sid;
          }
          $rand = mt_rand(10000, 99999);
        

            $user = User::create([
                'name'=> $request->name,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'UID'=>$rand,
                'SID'=>$sid
            ]);

            $token = JWTAuth::fromUser($user);

            return response()->json(compact('user','token'), 201);

    }

    public function login(Request $request){
        $credentials = $request->all();
        try {
            if(! $token = JWTAuth::attempt($credentials)){
               
                    return response()->json(['error'=>'invalid Credentials'], 400);
            }
            
        }catch (JWTException $e){
            return response()->json(['error'=>'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));

    }

    public function getAuthenticatedUser(){
        try{
            if(!$user = JWTAuth::parseToken()->authenticate()){
                return response()->json(['user_not_found'], 400);
            }
        }catch (TokenExpiredException $e){
            return response()->json(['token_expired']);
        }catch (TokenInvalidException $e){
            return response()->json(['token_invalid']);
        }catch (JWTException $e){
            return response()->json(['token_absent']);
        }
        $totalperson = User::where('sid',$user->UID)->count();
        $credit = wallet::where('credit',1)->where('user_id',$user->id)->sum('balance');
        $debit = wallet::where('debit',1)->where('user_id',$user->id)->sum('balance');
        $balance = $credit - $debit;
        // $balance = wallet::where('user_id',$user->id)->where('credit',1)->sum('balance');
        $game_record = game::where("user_id",$user->id)->orderBy("id","desc")->get()->map(function($data){
            $res = result::where("game_id",$data->game_id)->first();
         
            $game_id = game_id::where("id",$data->game_id)->first();
            $game = game::where("game_id",$game_id->id)->where("colnum",$data->colnum)->first();
            $data->amount = $data->amount;
            $data->colnum = $data->colnum;
            $data->game_id = $data->game_id;

            if($game){
                $data->profit = $game->profit;
            }
            else{
                $data->profit = 0;
            }
            if($res){
                $data->result = $res->number;
                $data->rsltClr = explode(",",$res->result);
            }
            $data->game_status = $game_id->expire;
            $data->period = $game_id->game_id;
            return $data;
        });
        $payment_history = payment::where("user_id",$user->id)->get();
        $withdraw_history = withdraw::where("user_id",$user->id)->get();
        $bonus_record = wallet::where('wallet_type',1)->where('user_id',$user->id)->orderBy("id","desc")->get();
        $bonus = wallet::where('wallet_type',1)->where('user_id',$user->id)->sum('balance');
        $exchange_bonus = wallet::where('is_exchanged',1)->where('user_id',$user->id)->sum('balance');
        $total_bonus = $bonus - $exchange_bonus;
        $invite_record = User::where("SID",$user->UID)->get()->map(function($data){
            // $contribute =wallet::where('user_id',$data->id)->sum('balance');
            // $data->contribute = $contribute;
            return $data;
        });
        $exchange_record = wallet::where("user_id",$user->id)->where('is_exchanged',1)->get()->map(function($data){
            $user = User::where("id",$data->user_id)->first();
            $data->user_name = $user->name;
            $data->user_phone = $user->phone;
            return $data;
        });
        $contribute = User::join("wallets","users.id","wallets.user_id")->where("users.SID",$user->UID)->sum("wallets.balance");
        $credittody = wallet::where('credit',1)->where('user_id',$user->id)->whereDate('created_at',\Carbon\Carbon::today())->sum('balance');
        $debittody = wallet::where('debit',1)->where('user_id',$user->id)->whereDate('created_at',\Carbon\Carbon::today())->sum('balance');
        $statics = $credittody - $debittody;
        $invite_rule = level::orderBy('level','asc')->get();
    //     $level1users = User::where("SID",$user->UID)->get();
    //     $level2users = [];
    //     $level3users = [];
    //     $level4users = [];
    //     $level2= [];
    //     $level3= [];
    //     $level4= [];
    //     if(count($level1users) > 0 ){
    //     foreach($level1users as $level1){
    //         $level2[] = User::where('SID',$level1->UID)->get();
    //         $level2users[] = User::where('SID',$level1->UID)->count();
    //     }
    //     }
    //     if($level2users > 0 ) {
    //     foreach($level2 as $level){
    //         $level3[] = User::where('SID',$level->UID)->get();
    //         $level3users[] = User::where('SID',$level->UID)->count();
    //     }
    // }
    //     if($level3users > 0){
      
    //     foreach($level4 as $level){
    //         // $level4[] = User::where('SID',$level->UID)->get();
    //         $level4users[] = User::where('SID',$level->UID)->count();
    //     }
    // }
    //     \Log::info($level1users ,$level2users,$level3users,$level4users);
        return response()->json(compact('user','balance','totalperson','game_record','payment_history','withdraw_history','bonus_record','total_bonus','invite_record','exchange_record','contribute','statics','invite_rule'));
    }

    public function adminLogin(){
    
        if(Auth::check()){
            return redirect('admin/dashboard');
        }
        return view('admin.login');
    }

    public function postLogin(Request $request){
        $input = $request->all();
   
        
        // $this->validate($request, [
        //     'phone' => 'required',
        //     'password' => 'required',
        // ]);
   
        if(auth()->attempt(array('phone' => $input['phone'], 'password' => $input['password'])))
        {
            if (auth()->user()->is_admin == 1) {

                return redirect("admin/dashboard");
            }else{
               
                return redirect()->route('home');
            }
        }else{
            return redirect("admin/login")
                ->with('error','Email-Address And Password Are Wrong.');
        }
    }
    public function dashboard(){
        if (auth()->user()->is_admin == 1) {
            $totalUser = User::where("is_admin","!=",1)->count();
            $credit = wallet::where('credit',1)->sum('balance');
            $debit = wallet::where('debit',1)->sum('balance');
            $usersBal = $credit - $debit;
            $totalGame = game_id::whereDate('updated_at', \Carbon\Carbon::today())->where("expire",1)->count();
            $todayAmount = game::whereDate('updated_at', \Carbon\Carbon::today())->sum("amount");
            $totalGames = game_id::where("expire",1)->count();
            $userAmount = game::sum("amount");
            return view("admin.dashboard",compact("totalUser","usersBal","totalGame","userAmount","totalGames","todayAmount"));
        }
        else{
            return redirect()->route('home');
        }
    }
   
    public function getUsers(Request $request){
        if($request->search){
            $users = User::where('id',$request->search)->orWhere('phone',$request->search)->orWhere('name','like','%'.$request->search.'%')->get();
        }
        else{
        $users = User::where('is_admin','!=',1)->get();
        }
        return view('admin.users',compact('users'));
    }
  
    public function updateUser($id, Request $request){
        $user = User::findOrFail($id);
        $wall = wallet::where('user_id',$id)->first();
        if(!$wall){
        $wallet = wallet::create([
            'user_id' => $id,
            'balance'=>$request->bal
        ]);
    }
        else{
            $wallet = wallet::where('user_id',$id)->update([
                'balance'=>$request->bal
            ]);
        }
        return redirect()->route('admin.users');
    }

    public function balcut($id){
        $user = User::findOrFail($id);
        return view('admin.cutBal',compact('user'));
    }
    public function baladd($id){
        $user = User::findOrFail($id);
        return view('admin.addBal',compact('user'));
    }
    public function addBalance(Request $request,$id){
        $wallet = new wallet();
        $wallet->user_id = $id;
        $wallet->credit = 1;
        $wallet->balance = $request->bal;
        $wallet->save();
        return redirect()->route('admin.users');
    }
    public function cutBalance(Request $request,$id){
        $bal = wallet::where('user_id',$id)->where('credit',1)->sum('balance');
        if($bal > $request->bal){
        $wallet = new wallet();
        $wallet->user_id = $id;
        $wallet->debit = 1;
        $wallet->balance = $request->bal;
        $wallet->save();
        return redirect()->route('admin.users');
        }
        else{
            return redirect()->back()->with('error','not enough balance to debit');
        }
    }

    public function bet($id,Request $request){
        if($request->minute >0 || $request->second >=16){
            $last_id = game_id::where("expire",0)->orderBy("id","desc")->first();
            $game = game::where("user_id",$id)->where("game_id",$last_id->id)->count();
            $last_id = game_id::where("expire",0)->orderBy('id',"desc")->first();
            $count = game_id::where("expire",0)->count();
            $cg = game::where("colnum","Green")->where('user_id',$request->user_id)->where("game_id",$last_id->id)->count();
            $cr = game::where("colnum","Red")->where('user_id',$request->user_id)->where("game_id",$last_id->id)->count();
            $con = game::where('user_id',$request->user_id)->orderBy('id','desc')->where("game_id",$last_id->id)->first();
           
                
            if($game < 7){
                if($cg>0 && $request->colnum =="Red"){
                    return response()->json(["error"=>'you are not allowed to use '.$request->colnum.' color. Please read game rule carefully'],401);
                }
                elseif($cr>0 && $request->colnum =="Green"){
                    return response()->json(["error"=>'you are not allowed to use '.$request->colnum.' color. Please read game rule carefully'],401);
                }
                else{ 
                $wallet = new wallet();
                $wallet->user_id = $id;
                $wallet->debit = 1;
                $wallet->balance = $request->balance;
                $wallet->save();
                $credit = wallet::where('credit',1)->where('user_id',$id)->sum('balance');
                $debit = wallet::where('debit',1)->where('user_id',$id)->sum('balance');
                $balance = $credit - $debit;

                if($balance > $request->amount){
                    $logedUser = User::where('id',$id)->first();
                    $Spid = $logedUser->SID;
                    $levelPlan = level::all();
                    $i = 0;
                    $admin = User::where("is_admin",1)->first();
                    // if ($request->wallet != "RRP") {
                foreach ($levelPlan as $k => $level) {
                    if ($Spid == 0 || $Spid == '0') {
                        break;
                        exit;
                    }
                    $con  = $level['direct'];
                    $directUser = User::where('SID', $Spid)->count();
                    $Sponsorid =  User::where('UID', $Spid)->get();  //uid
                    if ($directUser < $con && $request->balance == 0) {
                        $Spid = $Sponsorid[0]->SID;
                        $i++;
                        continue;
                        exit;
                    }
                
                    if ( $Spid != 1 && $request->balance > 0) {
                        $profit = $request->balance * $level['percentage'] / 100;
                        // u_wa_u_wallet = new wallet_leveincome;
                        $u_wallet = new wallet();
                        $u_wallet->user_id = $Sponsorid[0]->id;
                        // \Log::info($Sponsorid);
                        $u_wallet->user_uid = $Sponsorid[0]->UID;
                        $u_wallet->user_name = $Sponsorid[0]->name;
                        if ($directUser < $con ) {
                            $u_wallet->balance = 0;
                        }
                        else {
                            $u_wallet->balance = $profit;
                        }
                    
                        $u_wallet->credit = 1;
                        $u_wallet->level = $level['level'];
                        // $u_wallet->level = Auth::user()->level;
                        $u_wallet->description = "level bonus income for " . $level['level'] . " level from #" . $logedUser->UID . ' ' .  $logedUser->name . " user";
                        $u_wallet->from_uid = $logedUser->UID;
                        $u_wallet->type =  "Level";
                        $u_wallet->wallet_type = 1;
                        $u_wallet->save();
                        $Spid = $Sponsorid[0]['SID'];
                        $i++;
                    }
                }
                     return response()->json([$balance],200);
                }
                else{
                    return response()->json("not enough balance to bet");
                }
            }
        }
            else{
                return response()->json(["error"=> "Please Read rules carefully.Next Time your account will be freezed"],401);
            }
    }
    else{
        return response()->json(["error"=>"time is over"],401);
    }
    }

    public function resetpwd($id,Request $request){
        User::where('id',$id)->update([
            'password'=>Hash::make($request->pwd)
        ]);
        return response()->json(200);
    }
    public function resetname($id,Request $request){
        User::where('id',$id)->update([
            'name'=>$request->name
        ]);
        return response()->json(200);
    }

    public function upload(Request $request,$id){
        // $this->validate($request,[
        //     'file'=> 'required|mimes:jpeg,png,jpg'
        // ]);
         $picName = time().'.'.$request->file->extension();
        $request->file->move(public_path('uploads'),$picName);
        $user = User::where('id',$id)->update([
            'image'=> $picName
        ]);

        return $picName;
    }
    
}
