@extends('layouts.adminapp')
@section('content')
<style>
    .display>tbody>tr>th , .display>tbody>tr>td{
        color: black !important;
    }
 </style>
<style>
    tbody > tr > td> .Red {
    /* width: 100%; */
    /* height: 10px; */
    background: red;
    display: inline-block;
    border-radius: 100px;
    margin-top: 14px;
    padding: 6px;
    text-align: center;
    /* margin-left: 50%; */
}
tbody > tr >td> .Green {
    /* width: 100%; */
    /* height: 10px; */
    background: rgb(15, 172, 15);
    display: inline-block;
    border-radius: 100px;
    margin-top: 14px;
    padding: 6px;
    text-align: center;
    /* margin-left: 50%; */
}
tbody > tr >td>.Violet {
    /* width: 100%; */
    /* height: 10px; */
    background: purple;
    display: inline-block;
    border-radius: 100px;
    margin-top: 14px;
    padding: 6px;
    text-align: center;
    /* margin-left: 50%; */
}

</style>
<div class="breadcrumbbar">
    <div class="align-items-center">
       <h3 >Game Records</h3>
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
        <th>Color/Number</th>
        <th>User Id</th>
        <th>User Phone</th>
        <th>User Amount</th>
        <th>Profit</th>
    </tr>   
    @if (!empty($colors))
       @foreach ($colors as $color)
           <tr>
               <td><span class="{{$color->betType == 'color'? $color->colnum:''}}"></span>{{$color->betType =="number" ? $color->colnum:''}}</td>
               <td >{{$color->user_id}}</td>
               <td>{{$color->phone}}</td>
               <td>{{$color->amount}}</td>
               <td>{{$color->profit}}</td>
           </tr>
       @endforeach
    @endif
    </table> 
    </div>
        </div>
    </div>
    
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
  $(document).ready(function(){
  $("#delete").click(function(){
    if (!confirm("Do you want to delete")){
        return false;
        }
        else{
            return true;
        }
    });
    
  });
  </script>
  
@endsection