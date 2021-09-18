@extends('layouts.adminapp')
@section('content')
<style>
    .display>tbody>tr>th , .display>tbody>tr>td{
        color: black !important;
    }
 </style>
<div class="breadcrumbbar">
    <div class="align-items-center">
       <h3 >User Withdraws</h3>
    </div> 
         
</div>
<div class="contentbar"> 
    <div class="card">
        <div class="card-body">
    <div class="table-responsive">
        <table id="default-datatable" class=" display table table-striped table-bordered" id="edit-btn">
    <tr>
        <th>User ID</th>
        <th>User UID</th>
        <th>User Name</th>
        <th>Bank Name</th>
        <th>User Phone</th>
        <th>User Email</th>
        <th>Amount</th>
       <th>Action</th>
    </tr>   
    @if(!empty($withs))
    @foreach($withs as $wd)
    <tr>
    <td> {{$wd->user_id}}</td>  
    <td>{{$wd->user_uid}}</td>                  
    <td>{{$wd->user_name}}</td>   
    <td>{{$wd->bank_name}}</td>                 
    <td>{{$wd->phone}}</td>                 
    <td>{{$wd->email}}</td>                 
    <td>{{$wd->amount}}</td>                 
  
    <td>
        @if ($wd->status == 0)
        <button type="button" id="accept" data-id="{{$wd->id}}"  data-target="#paymentModal"  data-toggle="modal" class="btn btn-success" >Accept</button>
        @elseif($wd->status == 1)
        <div class="text-success"> Accepted</div>
        @endif
        @if ($wd->status == 0)
        <button type="button" id="reject"  data-id="{{$wd->id}}" data-uid="{{$wd->user_id}}" data-amount="{{$wd->amount}}" data-target="#rejectModal"  data-toggle="modal" class="btn btn-danger" >Reject</button>
        @elseif($wd->status == -1)
        <div class="text-danger"> Rejected</div>
        @endif

        {{-- <form  action="{{ route('admin.rejectWd') }}" method="POST"  class="d-inline">
            @csrf
            <input type="hidden" name="user_id" value="{{$wd->user_id}}">
            <input type="hidden" name="amount" value="{{$wd->amount}}">
            @if ($wd->status ==0)
            <button type="submit"  class="btn btn-danger" {{$wd->status == -1?'disabled':''}}>{{$wd->status == -1?'Rejected':'Reject'}}</button>
            @elseif($wd->status == -1)
                <div class="text-danger">Rejected</div>
            
            @endif
        </form> --}}
    </td>          
    </tr> 
   @endforeach
   @endif
    </table> 
    </div>
        </div>
    </div>
</div>
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Accept Payment</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form  action="{{ route('admin.acceptWd') }}" method="POST" >
            @csrf
        <div class="modal-body">
                <div class="form-group">
                    <label > Review</label>
                    <textarea type="text" name="review" value="" class="form-control" id="review"></textarea>
                </div>
                <input type="hidden" name="id" value="" id="id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" >Accept</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  {{-- reject model --}}
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Reject Payment</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form  action="{{ route('admin.rejectWd') }}" method="POST" >
            @csrf
        <div class="modal-body">
                <div class="form-group">
                    <label > Review</label>
                    <textarea type="text" name="review" value="" class="form-control" id="review"></textarea>
                </div>
                <input type="hidden" name="id" value="" id="id1">
                <input type="hidden" name="user_id" value="" id="uid">
                <input type="hidden" name="amount" value="" id="amount">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" >Reject</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script>
      $(document).ready(function(){
          $("#accept").click(function(){
              var id = $(this).data("id");
              console.log("id:"+id);
              $("#id").val(id);
            
          });
          $("#reject").click(function(){
              var id1 = $(this).data("id");
              var uid = $(this).data("uid");
              var amount = $(this).data("amount");
              console.log("id:"+id);
              console.log("uid:"+uid);
              console.log("amount:"+amount);
              $("#id1").val(id1);
              $("#amount").val(amount);
              $("#uid").val(uid);
            
          });
      })
  </script>
@endsection