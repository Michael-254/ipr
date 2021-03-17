@extends('todos.layout')
@section('content')
<h2>TODOs Table</h2>
<a href="{{route('todo.create')}}">Create TODO</a>
<form action="{{route('todo.update',$todos->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('patch')
<table class="table">
  <thead>
    <tr>
      @include('components.alert')
      <th>ID</th>
      <th>NAME</th>
      <th>STATUS</th>
    </tr>
  </thead>
  <tbody>
     <tr>
         <td>{{$todos->id}}</td>
         <td width:100px;><input type="text" name="name" value="{{$todos->name}}"></td>
         <td>{{$todos->completed}}</td>
         <td><input type="submit" value="update"></td>
     </tr>
   </tbody>
   </table>
 </form>
@endsection
