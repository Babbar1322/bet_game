@extends('layouts.adminapp')
@section('content')
<style>
    .display>tbody>tr>th , .display>tbody>tr>td{
        color: black !important;
    }
 </style>
<div class="breadcrumbbar">
    <div class="align-items-center">
       <h3 >Amount Percentage</h3>
    </div> 
    <div class="text-right">
        @if (count($pers) == 0)
        <a href="{{route('admin.addPer')}}" class="btn btn-info">+ Add Per</a>    
        @endif
    </div>         
</div>
<div class="contentbar"> 
    <div class="card">
        <div class="card-body">
    <div class="table-responsive">
        <table id="default-datatable" class=" display table table-striped table-bordered" id="edit-btn">
    <tr>
      
        <th>Manual Play</th>
        <th>Amount Percentage</th>
       <th>Action</th>
    </tr>   
    <tr>
        <td>
            <form action="{{route('admin.play')}}" method="post">
                @csrf
                <button type="submit" class="btn btn-success"> Play</button>
            </form>
        </td>
    @if (!empty($pers))
        
    @foreach ($pers as $per)
     
    <td>{{$per->percentage}}</td>   
    
    <td style="white-space: nowrap; width: 15%;">
        <div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
        <div class="btn-group btn-group-sm" style="float: none;">
        <a  href="{{route('admin.editPer',['id'=>$per->id])}}"   class="tabledit-edit-button btn btn-sm btn-info" style="float: none; margin: 5px;"><span class="ti-pencil"></span></a>
         <a href="{{route('admin.deletePer',['id'=>$per->id])}}" class="tabledit-delete-button btn btn-sm btn-danger" style="float: none; margin: 5px;"  id="delete"><span class="ti-trash"></span></a> 
        </div>
        </div>
</td>   
  
@endforeach
@endif

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