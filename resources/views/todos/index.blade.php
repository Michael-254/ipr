@extends('todos.layout')
@section('content')
<h2>TODOs Table</h2>
<a href="/todos/create">New TODO</a>
  @include('components.alert')
<table class="table">
  <thead>
    <tr>
      <th>ID</th>
      <th>NAME</th>
      <th>STATUS</th>
      <th>AMEND</th>
      <th>Show</th>
      <th>PRINTED</th>
      <th>Step</th>
    </tr>
  </thead>
  <tbody>
    @foreach($todos as $p)
     <tr>
         <td>{{$p->id}}</td>
         <td>{{ $p->name }}</td>
         <td>{{ $p->completed }}</td>
         <td><a href="{{route('todo.edit',$p->id)}}">Edit</a></td>
         <td><a href="{{route('todo.show',$p->id)}}">Role</a></td>
         @if($p->completed)
         <td><span role="button" onclick="event.preventDefault();document.getElementById('form-incomplete-{{$p->id}}').submit()">&#10003;</span></td>
         <form style="hidden" method="post" id="{{'form-incomplete-'.$p->id}}"action="{{route('todo.incomplete',$p->id)}}">
           @csrf
           @method('patch')
         </form>

         @else

         <td><span role="button" onclick="event.preventDefault();document.getElementById('form-complete-{{$p->id}}').submit()">&#10007;</span></td>
         <form style="hidden" method="post" id="{{'form-complete-'.$p->id}}"action="{{route('todo.complete',$p->id)}}">
           @csrf
           @method('patch')
         </form>
         @endif
     </tr>
    @endforeach
  </tbody>
</table>
@endsection
