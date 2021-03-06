@extends('todos.layout')

@section('content')
<h1 class="h3 mb-2 text-gray-800 text-success">IPRs</h1>
@include('layouts.flash')
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-success">IPRs Received</h6>
<a href="{{route('todo.create')}}" class="navbar-nav ml-auto">
  <span class="m-0 font-weight-bold text-primary navbar-nav ml-auto"><b>Create New IPR</b> </span>
</a>
</div>

<div class="card-body">
  @if($todos->count()==0)
  <center><p>No Iprs Available</p></center>
  @else
<div class="table-responsive">
<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
 <thead class="text-white" style="background-color:#007e33">
   <tr>
     <th>Date Created</th>
     <th>Created By</th>
      <th>Status</th>
     <th>Message</th>
     <th>HOD comment</th>
     <th>Op Comment</th>
     <th>MD/DFO Comment</th>
   </tr>
 </thead>
        @foreach($todos as $t)
           <tr>
              <td data-order='desc'>{{ $t->date_initiated}}</td>
              <td>{{ $t->initiator }}</td>
              <td>{{ $t->status }}</td>
              <td><a href="{{route('todo.showMD',$t->id)}}">View</a></td>
              <td>{{ $t->hodC }}</td>
              <td>{{ $t->opC }}</td>
              <td>{{ $t->mdC }}</td>

           </tr>
           @endforeach
 </tbody>
</table>
@endif
</div>
</div>
</div>
@endsection
