@extends('layouts.adminapp')
@section('content')
<div class="breadcrumbbar">
    <div class="align-items-center">
       <h3 class="text-center">Add Amount Percentage</h3>
        
        
    </div>          
</div>
<div class="contentbar">
    <div class="card">
    <div class="card-body">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form action="{{route('admin.updatePer',["id"=>$per->id])}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="per">Percentage</label>
                    <input type="text" class="form-control" name="per" value="{{$per->percentage}}">
                </div>
                
                <button class="btn btn-primary" type="submit">Save</button>
            </form>
        </div>
        <div class="col-md-3"></div>
    </div>    
    </div>    
    </div>  
</div>
@endsection