@extends('layouts.adminapp')
@section('content')
<style>
  .display>tbody>tr>th , .display>tbody>tr>td{
      color: black !important;
  }
</style>
<style>
    tbody > tr > .Red {
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
tbody > tr > .Green {
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
tbody > tr >.Violet {
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
        <th>Game Id</th>
        <th>Total Profit</th>
       <th>View More</th>
    </tr>   
    @if (!empty($records))
       @foreach ($records as $record)
           <tr>
               <td >{{$record->game_id}}</td>
               <td>{{round($record->profit,2)}}</td>
               
               {{-- <td><i class="fa fa-eye get" data-toggle="modal" data-target="#exampleModal" data-game_id="{{$record->id}}" ></i></td> --}}
               <td><a href="{{route('admin.recordDetails',['id'=> $record->id])}}" class="fa fa-eye get"></i></td>
           </tr>
       @endforeach
    @endif
    </table> 
    </div>
    {{$records->withPath('/Demo/admin/betRecords')}}
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <table class="table table-striped">
                <tr>
                    <th>Color/Number</th>
                    <th>Amount</th>
                    <th>User Id</th>
                    <th>User Phone</th>
                    <th>Profit</th>
                </tr>
                <tbody class="tr text-center">

                </tbody>
               
                
            </table>
            </div>
            {{-- <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div> --}}
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
    // $(".get").click(function(){
    //     var game_id = $(this).data("game_id");
    //     $(".tr").html("");
    //     $.ajax({
    //         url:"",
    //         method:"get",
    //         data:{
    //             game_id:game_id,
    //         },
    //         success:function(data){
    //           for(var i=0;i<data.color.length;i++){
    //               if(data.color[i].betType == 'color'){
    //                 $(".tr").append("<tr><td class='"+data.color[i].colnum+"'></td><td>"+data.color[i].amount+"</td><td>"+data.color[i].user_id+"</td><td>"+data.color[i].phone+"</td><td>"+data.color[i].profit+"</td></tr>")
    //               }
    //               else{
    //                 $(".tr").append("<tr><td>"+data.color[i].colnum+"</td><td>"+data.color[i].amount+"</td><td>"+data.color[i].user_id+"</td><td>"+data.color[i].phone+"</td><td>"+data.color[i].profit+"</td></tr>")
    //               }
    //           }
    //         }
    //     })
    // });
  });
  </script>
  
@endsection