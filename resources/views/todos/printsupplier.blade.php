<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>BGF | IPRs</title>
    <link rel="icon" type="img/ico" href="{{asset('/storage/images/logo.png')}}" />
  <!-- Custom fonts for this template-->
  <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
  <!-- Custom styles for this page -->
  <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  @livewireStyles
</head>
<div class="container-fluid">

          <!-- Page Heading -->
          <form class="text-center border border-light p-5" action="{{route('todo.updateSupplier',$todos->id)}}" method="post" enctype="multipart/form-data">
          @csrf
          @method('patch')
           @include('layouts.flash')
       <p class="h2 mb-4 text-success">Supplier</p><hr>

      <p class="h5 mb-4 text-info">Company Details</p>
        <div class="form-row mb-4">
           <div class="col">
              <label class="h6 mb-0 font-weight-bold text-success">Company Name</label>
         <textarea class="form-control"  name="company" rows="3" readonly>{{$todos->company}}</textarea>
           </div>
       <div class="col">
             <label class="h8 mb-0 font-weight-bold text-success">P.O Box</label>
              <input  name="box" class="form-control" value="{{$todos->box}}" readonly>
           </div>
            <div class="col">
              <label class="h8 mb-0 font-weight-bold text-success">Code</label>
              <input  name="code" class="form-control" value="{{$todos->code}}" readonly>
           </div>
         <div class="col">
              <label class="h8 mb-0 font-weight-bold text-success">City/Town</label>
              <input  name="city" class="form-control" value="{{$todos->city}}" readonly>
           </div>
        <div class="col">
              <label class="h8 mb-0 font-weight-bold text-success">Telephone/Cell Number</label>
              <input  type="number" name="tel" class="form-control"value="{{$todos->tel}}" readonly>
           </div>
       </div>
          <div class="form-row mb-4">
           <div class="col">
              <label class="h8 mb-0 font-weight-bold text-success">Website</label>
              <input  type="text" name="web" class="form-control" value="{{$todos->web}}" readonly>
           </div>
       <div class="col">
              <label class="h8 mb-0 font-weight-bold text-success">E mail</label>
              <input  type="text" name="mail" class="form-control" value="{{$todos->mail}}" readonly>
           </div>
        <div class="col">
              <label class="h8 mb-0 font-weight-bold text-success">Contact Person</label>
              <input  type="text" name="contact" class="form-control" value="{{$todos->contact}}" readonly>
           </div>
        <div class="col">
              <label class="h8 mb-0 font-weight-bold text-success">Nature of Business</label>
              <input  type="text" name="nature" class="form-control" value="{{$todos->nature}}" readonly>
           </div>
        <div class="col">
              <label class="h8 mb-0 font-weight-bold text-success">Physical Location</label>
              <input  type="text" name="location" class="form-control" value="{{$todos->location}}" readonly>
           </div>
       </div>
         <p class="h5 mb-4 text-info">EFT/RTGS Payments</p>
           <div class="form-row mb-4">
           <div class="col">
        <label class="h8 mb-0 font-weight-bold text-success">Account No.</label>
         <input  name="account" class="form-control" value="{{$todos->account}}" readonly>
           </div>
       <div class="col">
             <label class="h8 mb-0 font-weight-bold text-success">Bank</label>
              <input  name="bank" class="form-control" value="{{$todos->bank}}" readonly>
           </div>
            <div class="col">
              <label class="h8 mb-0 font-weight-bold text-success">Branch</label>
              <input  name="branch" class="form-control" value="{{$todos->branch}}" readonly>
           </div>
         <div class="col">
              <label class="h8 mb-0 font-weight-bold text-success">Swift</label>
              <input  name="swift" class="form-control" value="{{$todos->swift}}" readonly>
           </div>
        <div class="col">
              <label class="h8 mb-0 font-weight-bold text-success">Sort Code</label>
              <input  type="number" class="form-control" name="Scode" value="{{$todos->Scode}}" readonly>
           </div>
       </div>
      <p class="h5 mb-4 text-info">Mpesa Payments</p>
         <div class="form-row mb-4">
           <div class="col">
        <label class="h8 mb-0 font-weight-bold text-success">Mobile No.</label>
         <input  name="number" class="form-control" value="{{$todos->number}}" readonly>
           </div>
       <div class="col">
             <label class="h8 mb-0 font-weight-bold text-success">Till Number</label>
              <input  name="till" class="form-control" value="{{$todos->till}}" readonly>
           </div>
            <div class="col">
              <label class="h8 mb-0 font-weight-bold text-success">Pay Bill</label>
              <input  name="bill" class="form-control"  value="{{$todos->bill}}" readonly>
           </div>
       </div>
       <p class="h5 mb-4 text-info">Other Information</p>
         <div class="form-row mb-4">
           <div class="col">
        <label class="h8 mb-0 font-weight-bold text-success">Credit Duration</label>
         <input  name="Cduration" class="form-control"  value="{{$todos->Cduration}}" readonly>
           </div>
            <div class="col">
              <label class="h8 mb-0 font-weight-bold text-success">Credit Limit</label>
              <input  name="Climit" class="form-control"  value="{{$todos->Climit}}" readonly>
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
      </form>
</div>
@include('components.sum')
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('js/sb-admin-2.min.js')}}"></script>
<script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('js/demo/datatables-demo.js')}}"></script>
@livewireScripts
@include('components.sum')
</body>

</html>
