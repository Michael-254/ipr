@extends('todos.layout')

@section('content')
<h1 class="h3 mb-2 text-gray-800 text-success">Registered Users</h1>
@include('layouts.flash')
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-success">Users</h6>
<a href="{{route('todo.create')}}" class="navbar-nav ml-auto">
  <span class="m-0 font-weight-bold text-primary navbar-nav ml-auto"><b>Create New IPR</b> </span>
</a>
</div>

<div class="card-body">
<div class="table-responsive">
<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
 <thead class="text-white" style="background-color:#007e33">
   <tr>
     <th>Name</th>
      <th>Site</th>
     <th>SLM</th>
     <th>HOD</th>
     <th>OP</th>
     <th>Director</th>
     <th>Admin</th>
   </tr>
 </thead>
        @foreach($todos as $t)
           <tr>
              <td>{{ $t->name}}</td>
              <td>{{ $t->site }}</td>
              <td>@if($t->slm)<span class="text-primary">Yes<span/>@else<span class="text-danger">No<span/>@endif</td>
              <td>@if($t->hod)<p class="text-primary">Yes</p>@else<p class="text-danger">No</p>@endif</td>
              <td>@if($t->op)<p class="text-primary">Yes</p>@else<p class="text-danger">No</p>@endif</td>
              <td>@if($t->md)<p class="text-primary">Yes</p>@else<p class="text-danger">No</p>@endif</td>
              <td>@if($t->admin)<p class="text-primary">Yes</p>@else<p class="text-danger">No</p>@endif</td>
           </tr>
           @endforeach
 </tbody>
</table>
</div>
</div>
</div>
@endsection
