<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\withdraw;
use App\wallet;
use App\User;

class WithdrawController extends Controller
{
   public function store(Request $request){
        withdraw::create([
            "user_id"=>$request->user_id,
            "user_uid"=>$request->user_uid,
            "user_name"=> $request->user_name,
            "amount"=> $request->amount,
            "bank_name"=> $request->bank_name,
            "phone"=> $request->phone,
            "email"=> $request->email,
        ]);
        $wallet = wallet::create([
            "user_id"=> $request->user_id,
            "balance"=> $request->amount,
            "debit"=> 1
        ]);
        return response()->json(["res"=>"withdraw request sent to admin","wallet"=>$wallet],200);
   }

   public function wdRequest(){
       $withs = withdraw::where("status","!=",0)->orderBy("id","desc")->get();
       return view("admin.withdraw",compact('withs'));
   }
   public function pendingRequest(){
       $withs = withdraw::where("status",0)->orderBy("id","desc")->get();
       return view("admin.pendingReq",compact('withs'));
   }
   public function acceptWd(Request $request){
        withdraw::where('id',$request->id)->update([
            "status"=>1
        ]);
        return redirect()->route('admin.wdRequest');
   }
   public function rejectWd(Request $request){
    $with = withdraw::where('id',$request->id)->update([
        "status"=>-1
    ]);
    wallet::create([
        "credit"=>1,
        "user_id"=>$request->user_id,
        "balance"=>$request->amount
    ]);
    return redirect()->route('admin.wdRequest');

   }

   public function transactions(){
       $trans = wallet::where("level",null)->orderBy("id","desc")->paginate(10);
       //    $trans = wallet::distinct()->orderBy("id","desc")->get(['user_id'])->map(function($data){
       //        $credit_amount = wallet::where('credit',1)->where("user_id",$data->user_id)->sum("balance");
       //        $debit_amount = wallet::where('debit',1)->where("user_id",$data->user_id)->sum("balance");
       //        $user = User::where("id",$data->user_id)->first();
       //        $data->credit_amount = $credit_amount;
       //        $data->debit_amount = $debit_amount;
       //        $data->user_name = $user->name;
       //        return $data;
       //    });
       
        // ->map(function($data){
        //     $credit = wallet::where('credit',1)->where("user_id",$data->user_id)->first();
        //     $debit = wallet::where('debit',1)->where("user_id",$data->user_id)->first();
        //     // $data->credit_amount = $credit->balance;
        //     $data->debit_amount = $debit->balance;
        //     $user = User::where("id",$data->user_id)->first();
        //     $data->phone = $user->phone;
        //     return $data;
        // });
       return view("admin.transactions",compact("trans"));
   }

   public function levelTrans(){
    $trans = wallet::whereNotNull("level")->orderBy("id","desc")->paginate(10);
    return view("admin.levelTrans",compact("trans"));

   }

   public function getRecords(){
       $with = withdraw::orderBy("id","desc")->get();
       return response()->json($with);
   }
}
