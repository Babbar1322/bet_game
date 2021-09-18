<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\payment;
use App\wallet;
use App\timer;
use App\amountPer;

class PaymentController extends Controller
{
    public function index(){
        $pays = payment::get();
        return view('admin.userPayment',compact('pays'));
    }
    public function payment(Request $request , $id){
        $paym = payment::where('ref_no', $request->refno)->first();
        if($paym){
            return response()->json(["res"=>" reference Id already exist"],401);
        }
        else{
        $user = User::where('id',$id)->first();
        $pay = payment::create([
            'user_id'=>$id,
            'user_name'=>$user->name,
            'amount'=>$request->amount,
            'upi_id'=>$request->upi,
            'ref_no'=> $request->refno
        ]);
       
        return response()->json(["res"=>"payment successfull"],200);
        }
    }
    public function accept(Request $request){
        $pay= payment::where('user_id',$request->user_id)->where('ref_no',$request->ref_no)->update([
            'status'=>1,
            'amount'=>$request->amount
        ]);
        if($pay){
            wallet::create([
                'balance'=>$request->amount,
                'user_id'=> $request->user_id,
                'credit'=>1
            ]);
        }
        return redirect()->back();
    }
    public function reject(Request $request){
        $pay= payment::where('user_id',$request->user_id)->where('ref_no',$request->ref_no)->update([
            'status'=>-1
        ]);
       
        return redirect()->back();
    }

    public function storeTime(Request $request){
        
        timer::create([
            'start_time'=>round(microtime(true)*1000), 
            'end_time'=> round(microtime(true)*1000 + 60000 * 5)
        ]);
    }
    public function getTime(){
        $timer = timer::orderBy('id','desc')->first();
        return response()->json(compact('timer'));
    }

    public function amountPers(){
        $pers = amountPer::get();
        return view("admin.amountPer",compact('pers'));
    }
    public function addPer(){
        return view('admin.addPer');
    }
    public function editPer($id){
        $per = amountPer::findOrFail($id);
        return view('admin.editPer',compact("per"));

    }
    public function storePer(Request $request){
        amountPer::create([
            "percentage"=> $request->per
        ]);
        return redirect()->route("admin.amountPer");
    }
    public function updatePer(Request $request , $id){
        amountPer::where("id",$id)->update([
            "percentage"=> $request->per
        ]);
        return redirect()->route("admin.amountPer");
    }
    public function deletePer($id){
        amountPer::where("id",$id)->delete();
        return redirect()->route("admin.amountPer");
    }
    public function exchangeBal(Request $request){
        wallet::create([
            'user_id'=> $request->user_id,
            "balance"=> $request->amount,
            "is_exchanged"=>1
        ]);
        return response()->json(200);
    }
}
