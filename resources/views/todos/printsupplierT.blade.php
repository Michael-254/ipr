@extends('todos.layout')

@section('content')
<h1 class="h3 mb-2 text-gray-800 text-success">Suppliers</h1>
@include('layouts.flash')
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-success">Print Supplier</h6>
<a href="{{route('todo.create')}}" class="navbar-nav ml-auto">
  <span class="m-0 font-weight-bold text-primary navbar-nav ml-auto"><b>Create New IPR</b> </span>
</a>
</div>

<div class="card-body">
  @if($todos->count()==0)
  <center><p>No Supplier Available for Printing</p></center>
  @else
<div class="table-responsive">
<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
 <thead class="text-white" style="background-color:#007e33">
   <tr>
     <th>Introduced By</th>
     <th>Site</th>
      <th>Company Name</th>
     <th>View</th>
     <th>Documents</th>
   </tr>
 </thead>
        @foreach($todos as $t)
           <tr>
              <td>{{ $t->intro}}</td>
              <td>{{ $t->site }}</td>
              <td>{{ $t->company }}</td>
              <td><a href="{{route('todo.printSupplier',$t->id)}}">View</a></td>
              @if($t->file != "")
              <td><a href="{{route('todo.supplierdoc',$t->id)}}">Attachments</a></td>
              @else
              <td></td>
              @endif
           </tr>
           @endforeach
 </tbody>
</table>
@endif
</div>
</div>
</div>
@endsection
