@extends('layouts.adminapp')
@section('content')
<div class="breadcrumbbar">
    <div class="align-items-center">
       <h3 >Manual Play</h3>
    </div> 
        
</div>
<div class="contentbar"> 
    <div class="card">
        @if (session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="card-body">
    <div class="table-responsive">
        <table id="default-datatable" class=" display table table-striped table-bordered" id="edit-btn">
    <tr>
        <th>Click to store time for next game and get result for previous game</th>
    </tr>   
    <tr>
        <td>
            <form action="{{route('admin.play')}}" method="post">
                @csrf
                <button type="submit" class="btn btn-success"> Play</button>
            </form>
        </td>
    </tr>
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