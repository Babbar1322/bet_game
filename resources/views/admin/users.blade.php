@extends('layouts.adminapp')
@section('content')
<style>
    .display>tbody>tr>th , .display>tbody>tr>td{
        color: black !important;
    }
 </style>
<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">All Users</h4>
          
        </div>
        <div class="col-md-4 col-lg-4">
      <div class="searchbar">
            <form action="" method="get">
                <div class="input-group">
                  <input type="search" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2" name="search">
                  <div class="input-group-append">
                    <button class="btn" type="submit" id="button-addon2" style="background-color:lightgray;"><img src="{{asset('admin/assets/images/svg-icon/search.svg')}}" class="img-fluid" alt="search" style="min-width:20px;"></button>
                  </div>
                </div>
            </form>
        </div>
        </div>
    </div>         
</div>
<div class="contentbar"> 
    <div class="card">
        <div class="card-body">
    <div class="table-responsive">
        <table id="default-datatable" class="display table table-striped table-bordered" id="edit-btn">
    <tr>
        <th>Name</th>
        <th>Phone</th>
        <th>Balance</th>
        <th>Referred By Name/Phone</th>
       <th>Amount</th>
    </tr>   
    @if (!empty($users))
        
    @foreach ($users as $user)
    @php
        $credit = \App\wallet::where('credit',1)->where('user_id',$user->id)->sum('balance');
        $debit = \App\wallet::where('debit',1)->where('user_id',$user->id)->sum('balance');
        $balance = $credit - $debit;
        $usr = \App\User::where("SID",$user->UID)->first();
    @endphp
    <tr>
    <td>{{$user->name}}</td>  
    <td>{{$user->phone}}</td>  
    <td>{{$balance}}</td>  
    <td>{{$user->name !="" ? $user->name : $user->phone }}</td>  
    <td>
       <a href="{{route('admin.balanceadd',['id'=>$user->id])}}" class="btn btn-success">Send </a>
       {{-- <a href="{{route('admin.balancecut',['id'=>$user->id])}}" class="btn btn-danger"> cut </a> --}}
    </td>           
               
    </tr> 
    @endforeach
    @endif
    </table> 
    </div>
        </div>
    </div>
</div>
@endsection