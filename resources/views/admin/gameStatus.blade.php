@extends('layouts.adminapp')
@section('content')
<style>
    .display>tbody>tr>th , .display>tbody>tr>td{
        color: black !important;
    }
 </style>
<style>
     .Red {
    /* width: 100%; */
    /* height: 10px; */
    background: red;
    display: inline-block;
    border-radius: 100px;
    margin-top: 14px;
    padding: 6px;
    text-align: center;
    margin-left: 10px;
}
 .Green {
    /* width: 100%; */
    /* height: 10px; */
    background: rgb(15, 172, 15);
    display: inline-block;
    border-radius: 100px;
    margin-top: 14px;
    padding: 6px;
    text-align: center;
    margin-left:10px;
}
.Violet {
    /* width: 100%; */
    /* height: 10px; */
    background: purple;
    display: inline-block;
    border-radius: 100px;
    margin-top: 14px;
    padding: 6px;
    text-align: center;
    margin-left: 10px;
}
.purple{
    border:1px solid purple;
    color: purple;
}
.purple:hover{
    background-color:purple;
    border:1px solid purple;
}
.purple:active{
    background-color:purple !important;
    border:1px solid purple !important;
}

</style>
<div class="breadcrumbbar">
    <div class="align-items-center">
       <h3 class="text-center">Game Status</h3>

    {{-- @php
        $Redamount = App\game::join("game_ids","games.game_id","game_ids.id")->where("game_ids.expire",0)->where("games.colnum","Red")->sum("amount");
        $Greenamount = App\game::join("game_ids","games.game_id","game_ids.id")->where("game_ids.expire",0)->where("games.colnum","Green")->sum("amount");
        $Violetamount = App\game::join("game_ids","games.game_id","game_ids.id")->where("game_ids.expire",0)->where("games.colnum","Violet")->sum("amount");
    @endphp --}}


    <div class="row">
        <div class="col-md-6 mb-2">
            <table>
                <tr>
                 <th>
                    <span class="Red p-3"></span> 
                 </th>
                 <th>
                     <span class="Green p-3"></span>
                 </th>
                 <th>
                     <span class="Violet p-3"></span>
                 </th>
                </tr>
                <tr>
                    <td>
                     <div class="text-center">{{$colors['Red']}}</div>
                    </td>
                    <td>
                        <div class="text-center">{{$colors['Green']}}</div>
                    </td>
                    <td>
                        <div class="text-center">{{$colors['Violet']}}</div>
                    </td>
                </tr>
     </table>
        </div>
        <div class="col-md-6">
            <table class="mt-2 table-responsive">
                <tr>
                    <th>
                       <span class="btn btn-outline-primary purple">0</span>
                    </th>
                    <th>
                       <span class="btn btn-outline-success">1</span>
                    </th>
                    <th>
                       <span class="btn btn-outline-danger">2</span>
                    </th>
                    <th>
                       <span class="btn btn-outline-success">3</span>
                    </th>
                    <th>
                       <span class="btn btn-outline-danger">4</span>
                    </th>
                    <th>
                       <span class="btn btn-outline-success purple">5</span>
                    </th>
                    <th>
                       <span class="btn btn-outline-danger">6</span>
                    </th>
                    <th>
                       <span class="btn btn-outline-success">7</span>
                    </th>
                    <th>
                       <span class="btn btn-outline-danger">8</span>
                    </th>
                    <th>
                       <span class="btn btn-outline-success">9</span>
                    </th>
                </tr>
                <tr>
                    <td>
                        <div class="text-center">{{$numbers['0']}}</div>
                    </td>
                    <td>
                        <div class="text-center">{{$numbers['1']}}</div>
                    </td>
                    <td>
                        <div class="text-center">{{$numbers['2']}}</div>
                    </td>
                    <td>
                        <div class="text-center">{{$numbers['3']}}</div>
                    </td>
                    <td>
                        <div class="text-center">{{$numbers['4']}}</div>
                    </td>
                    <td>
                        <div class="text-center">{{$numbers['5']}}</div>
                    </td>
                    <td>
                        <div class="text-center">{{$numbers['6']}}</div>
                    </td>
                    <td>
                        <div class="text-center">{{$numbers['7']}}</div>
                    </td>
                    <td>
                        <div class="text-center">{{$numbers['8']}}</div>
                    </td>
                    <td>
                        <div class="text-center">{{$numbers['9']}}</div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
 
     
    </div> 
    {{-- <div class="text-right">
    <a href="{{route('admin.addLevel')}}" class="btn btn-info">+ Add Level</a>    
    </div>          --}}
    <label class="mt-5"> Enter Number to Declare Winner</label>
    <div> 
        <form action="{{route('admin.winner')}}" method="post" >
            @csrf
            <div class="form-row">
            <div class="col-md-2 my-1">
                <input type="number" name="result" class="form-control" min="0" max="9" placeholder="Number 0-9" style="border:1px solid black">
                <input type="hidden" name="game_id" value="{{$game_id->id}}">
            </div>
           <div class="col-auto my-1">
            <button type="submit" class="btn btn-primary" >Declare Winner</button>
           </div>
            </div>
        </form>
    </div>
    @error('result')
        <div class="text-danger">{{$message}}</div>  
    @enderror
</div>
<div class="contentbar"> 
    <div class="card">
        <div class="card-body">
    <div class="table-responsive">
        <table id="default-datatable" class="display table table-striped table-bordered" id="edit-btn">
    <tr>
        <th>Game Id</th>
        <th>User Id</th>
        <th> Color/Number | Bet Amount</th>
        <th>Status</th>
      
    </tr>   
    @if (!empty($games))
       @foreach ($games as $game)
           <tr>
               <td >{{$game->game_id}}</td>
               <td>{{$game->user_id}}</td>
               <td>
            <span class="{{$game->betType=='color'?$game->colnum:''}}">{{$game->betType=='number'?$game->colnum:''}}</span>
            | <span>{{$game->amount}}</span>
        </td>
               <td ><span class="text-danger">Running</span></td>
           </tr>
       @endforeach
       @endif
    @if(count($games)==0)
    <td>{{$game_id->game_id}}</td>
    <td></td>
    <td>0</td>
    <td><span class="text-danger">Running</span></td>
    @endif
    </table> 
    </div>
        </div>
    </div>
    
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
    function autoRefreshPage()
    {
        window.location = window.location.href;
    }
    setInterval('autoRefreshPage()', 150000);
</script>
@endsection