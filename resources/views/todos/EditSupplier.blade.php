@extends('todos.layout')
@section('content')
<div class="container-fluid">

          <!-- Page Heading -->
    <form class="text-center border border-light p-5" action="{{route('todo.updateMySupplier',$todos->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('patch')
     @include('layouts.flash')
 <p class="h2 mb-4 text-success">Authorize Supplier</p><hr>

<p class="h5 mb-4 text-info">Company Details</p>
  <div class="form-row mb-4">
     <div class="col">
        <label class="h6 mb-0 font-weight-bold text-success">Company Name</label>
   <textarea class="form-control"  name="company" rows="3" required="required">{{$todos->company}}</textarea>
     </div>
 <div class="col">
       <label class="h8 mb-0 font-weight-bold text-success">P.O Box</label>
        <input  name="box" class="form-control" value="{{$todos->box}}" required="required">
     </div>
      <div class="col">
        <label class="h8 mb-0 font-weight-bold text-success">Code</label>
        <input  name="code" class="form-control" value="{{$todos->code}}" required="required">
     </div>
   <div class="col">
        <label class="h8 mb-0 font-weight-bold text-success">City/Town</label>
        <input  name="city" class="form-control" value="{{$todos->city}}" required="required">
     </div>
  <div class="col">
        <label class="h8 mb-0 font-weight-bold text-success">Telephone/Cell Number</label>
        <input  type="number" name="tel" class="form-control"value="{{$todos->tel}}" required="required">
     </div>
 </div>
    <div class="form-row mb-4">
     <div class="col">
        <label class="h8 mb-0 font-weight-bold text-success">Website</label>
        <input  type="text" name="web" class="form-control" value="{{$todos->web}}" required="required">
     </div>
 <div class="col">
        <label class="h8 mb-0 font-weight-bold text-success">E mail</label>
        <input  type="text" name="mail" class="form-control" value="{{$todos->mail}}" required="required">
     </div>
  <div class="col">
        <label class="h8 mb-0 font-weight-bold text-success">Contact Person</label>
        <input  type="text" name="contact" class="form-control" value="{{$todos->contact}}" required="required">
     </div>
  <div class="col">
        <label class="h8 mb-0 font-weight-bold text-success">Nature of Business</label>
        <input  type="text" name="nature" class="form-control" value="{{$todos->nature}}" required="required">
     </div>
  <div class="col">
        <label class="h8 mb-0 font-weight-bold text-success">Physical Location</label>
        <input  type="text" name="location" class="form-control" value="{{$todos->location}}" required="required">
     </div>
 </div>
   <p class="h5 mb-4 text-info">EFT/RTGS Payments</p>
     <div class="form-row mb-4">
     <div class="col">
  <label class="h8 mb-0 font-weight-bold text-success">Account No.</label>
   <input  name="account" class="form-control" value="{{$todos->account}}">
     </div>
 <div class="col">
       <label class="h8 mb-0 font-weight-bold text-success">Bank</label>
        <input  name="bank" class="form-control" value="{{$todos->bank}}">
     </div>
      <div class="col">
        <label class="h8 mb-0 font-weight-bold text-success">Branch</label>
        <input  name="branch" class="form-control" value="{{$todos->branch}}">
     </div>
   <div class="col">
        <label class="h8 mb-0 font-weight-bold text-success">Swift</label>
        <input  name="swift" class="form-control" value="{{$todos->swift}}">
     </div>
  <div class="col">
        <label class="h8 mb-0 font-weight-bold text-success">Sort Code</label>
        <input  type="number" class="form-control" name="Scode" value="{{$todos->Scode}}">
     </div>
 </div>
<p class="h5 mb-4 text-info">Mpesa Payments</p>
   <div class="form-row mb-4">
     <div class="col">
  <label class="h8 mb-0 font-weight-bold text-success">Mobile No.</label>
   <input  name="number" class="form-control" value="{{$todos->number}}">
     </div>
 <div class="col">
       <label class="h8 mb-0 font-weight-bold text-success">Till Number</label>
        <input  name="till" class="form-control" value="{{$todos->till}}">
     </div>
      <div class="col">
        <label class="h8 mb-0 font-weight-bold text-success">Pay Bill</label>
        <input  name="bill" class="form-control"  value="{{$todos->bill}}">
     </div>
 </div>
 <p class="h5 mb-4 text-info">Other Information</p>
   <div class="form-row mb-4">
     <div class="col">
  <label class="h8 mb-0 font-weight-bold text-success">Credit Duration</label>
   <input  name="Cduration" class="form-control"  value="{{$todos->Cduration}}">
     </div>
      <div class="col">
        <label class="h8 mb-0 font-weight-bold text-success">Credit Limit</label>
        <input  name="Climit" class="form-control"  value="{{$todos->Climit}}">
     </div>
     <div class="col">
  <label class="h8 mb-0 font-weight-bold text-success">Introduced By</label>
   <input type="text" name="intro" readonly  class="form-control" value="{{$todos->intro}}">
     </div>
 <div class="col">
  <label class="h8 mb-0 font-weight-bold text-success">Site</label>
  <input type="text" readonly name="site" class="form-control" value="{{$todos->site}}">
     </div>
 </div>
 <div class="form-group">
         <div class="col-xl-2">
            <input type="file" class="justify-content-center" name="image" multiple='multiple'>
         </div>
      </div>
     <button class="btn btn-success " type="submit" name="submit" value="Submit">Update</button>
 <div>
 
    <p><a href="{{route('todo.supplierdoc',$todos->id)}}" target="_blank">{{$todos->file}}</a></p>
</div>
</form>
</div>
@endsection
