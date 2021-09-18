@extends('layouts.adminapp')
@section('content')
<div class="breadcrumbbar">
    <div class="align-items-center">
       <h3 class="text-center">Admin Dashboard</h3>
        
        
    </div>          
</div>
<div class="contentbar">  
    <div class="row">
     
        <!-- Start col -->
        @if (isset($totalUser))
            
      
        <div class="col-lg-3 col-xl-3">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <span class="action-icon badge badge-primary-inverse mr-0"><i class="feather icon-user"></i></span>
                        </div>
                        <div class="col-7 text-right">
                            <h5 class="card-title font-14">Total Users</h5>
                            <h4 class="mb-0">{{$totalUser}}</h4>
                        </div>
                    </div>
               
                </div>
            </div>            
        </div>
        @endif
        @if (isset($usersBal))
            
      
        <div class="col-lg-3 col-xl-3">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <span class="action-icon badge badge-primary-inverse mr-0"><i class="feather icon-user"></i></span>
                        </div>
                        <div class="col-7 text-right">
                            <h5 class="card-title font-14">All Users Wallet Balance</h5>
                            <h4 class="mb-0">{{round($usersBal,2)}}</h4>
                        </div>
                    </div>
               
                </div>
            </div>            
        </div>
        @endif
        @if (isset($totalGame))
        <div class="col-lg-3 col-xl-3">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <span class="action-icon badge badge-primary-inverse mr-0"><i class="feather icon-user"></i></span>
                        </div>
                        <div class="col-7 text-right">
                            <h5 class="card-title font-14">Total Today Games</h5>
                            <h4 class="mb-0">{{$totalGame}}</h4>
                        </div>
                    </div>
               
                </div>
            </div>            
        </div>
        @endif
        @if (isset($todayAmount))
        <div class="col-lg-3 col-xl-3">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <span class="action-icon badge badge-primary-inverse mr-0"><i class="feather icon-user"></i></span>
                        </div>
                        <div class="col-7 text-right">
                            <h5 class="card-title font-14">Today Bet Amount</h5>
                            <h4 class="mb-0">{{$todayAmount}}</h4>
                        </div>
                    </div>
               
                </div>
            </div>            
        </div>
        @endif
        @if (isset($totalGames))
        <div class="col-lg-3 col-xl-3">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <span class="action-icon badge badge-primary-inverse mr-0"><i class="feather icon-user"></i></span>
                        </div>
                        <div class="col-7 text-right">
                            <h5 class="card-title font-14">Total Games</h5>
                            <h4 class="mb-0">{{$totalGames}}</h4>
                        </div>
                    </div>
               
                </div>
            </div>            
        </div>
        @endif
        @if (isset($userAmount))
        <div class="col-lg-3 col-xl-3">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <span class="action-icon badge badge-primary-inverse mr-0"><i class="feather icon-user"></i></span>
                        </div>
                        <div class="col-7 text-right">
                            <h5 class="card-title font-14">Total Bet Amount</h5>
                            <h4 class="mb-0">{{$userAmount}}</h4>
                        </div>
                    </div>
               
                </div>
            </div>            
        </div>
        @endif
</div>
@endsection