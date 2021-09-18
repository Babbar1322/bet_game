@extends('layouts.adminapp')
@section('content')
<style>
    
    .display>tbody>tr>th , .display>tbody>tr>td{
        color: black !important;
    }
 
    tbody > tr > .Red {
    /* width: 100%; */
    /* height: 10px; */
    background: red;
    display: inline-block;
    border-radius: 100px;
    margin-top: 14px;
    padding: 6px;
    text-align: center;
    margin-left: 50%;
}
tbody > tr > .Green {
    /* width: 100%; */
    /* height: 10px; */
    background: rgb(15, 172, 15);
    display: inline-block;
    border-radius: 100px;
    margin-top: 14px;
    padding: 6px;
    text-align: center;
    margin-left: 50%;
}
tbody > tr >.Violet {
    /* width: 100%; */
    /* height: 10px; */
    background: purple;
    display: inline-block;
    border-radius: 100px;
    margin-top: 14px;
    padding: 6px;
    text-align: center;
    margin-left: 50%;
}

</style>
<div class="breadcrumbbar">
    <div class="align-items-center">
       <h3 >Transaction</h3>
    </div> 
    {{-- <div class="text-right">
    <a href="{{route('admin.addLevel')}}" class="btn btn-info">+ Add Level</a>    
    </div>          --}}
</div>
<div class="contentbar"> 
    <div class="card">
        <div class="card-body">
    <div class="table-responsive">
        <table id="default-datatable" class="display table table-striped table-bordered" id="edit-btn">
    <tr>
        <th>Id</th>
        <th>User Id</th>
        <th>User Name</th>
        <th>Phone</th>
        <th>Credit Amount</th>
        <th>Debit Amount</th>
        <th>Date</th>
    </tr>   
    @php
        $i=1;
    @endphp
    @if (!empty($trans))
       @foreach ($trans as $tran)
        @php
              $user = App\User::where('id',$tran->user_id)->first();
              $phone = $user->phone;
        @endphp
           <tr>
               <td>{{$i}}</td>
               <td >{{$tran->user_id}}</td>
               <td >{{$tran->user_name}}</td>
               <td >{{$phone}}</td>
               <td >{{$tran->credit == 1 ? $tran->balance:0}}</td>
               <td >{{$tran->debit == 1 ? $tran->balance:0}}</td>
               <td >{{$tran->created_at}}</td>
           </tr>
           @php
               $i++;
           @endphp
       @endforeach
       
    @endif
    </table> 
    {{$trans->links()}}
    </div>
        </div>
    </div>
    
</div>

  
@endsection