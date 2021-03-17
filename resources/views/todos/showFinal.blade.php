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
    <form class="text-center border border-light p-5" action="{{route('todo.updateHOD',$todos->id)}}" method="post" enctype="multipart/form-data">
    @csrf
     @method('patch')
     @include('layouts.flash')
     <p><img src="{{asset('/storage/images/logo.png')}}" class="img-fluid" width="50" height="50"></img>
     <p class="h2 mb-4 text-success">Internal Purchase Requisition Form</p><hr>
         <label class="h8 mb-0 font-weight-bold text-danger">Ref No:{{$todos->id}}</label><br>
         <label class="h8 mb-0 font-weight-bold text-primary">Site:{{$todos->initiator_site}}</label>
      @livewire('counter',['steps' => $todos->step])
     <div class="form-row mb-4">
       <div class="col">
       <label class="h6 mb-0 font-weight-bold text-success">Date</label>
       <input type="text"  readonly class="form-control" name="initiatedDate" value="{{$todos->date_initiated}}">
       </div>
     <div class="col">
     <label class="h6 mb-0 font-weight-bold text-success">VAT</label>
      <input class="form-control" readonly value="{{$todos->vat}}">
     </div>
     <div class="col">
     <label class="h6 mb-0 font-weight-bold text-success">Sum</label>
     <span class="text-danger" id="sum-field">0</span>
     </div>
     <div class="col">
     <label class="h6 mb-0 font-weight-bold text-success">Currency Type</label>
     <input class="form-control" readonly value="{{$todos->currency}}">
     </div>
     </div>
     <div class="form-row mb-4">
     <div class="col">
		 <label class="h6 mb-0 font-weight-bold text-success">Expected lead Time</label>
     <input type="number" name="leadT" readonly class="form-control" value="{{$todos->leadT}}">
     </div>
     <div class="col">
		 <label class="h6 mb-0 font-weight-bold text-success">Explanation if Urgent</label>
		 <textarea class="form-control" readonly name="urgencyE"  rows="2">{{$todos->explanation}}</textarea>
     </div>
     <div class="col">
		 <label class="h6 mb-0 font-weight-bold text-success">Prepared By</label>
     <input readonly class="form-control" name="userN" value="{{$todos->initiator}}">
     </div>
     <div class="col">
		 <label class="h6 mb-0 font-weight-bold text-success">Department</label>
     <input readonly class="form-control" name="department"  value="{{$todos->department}}">
     </div>
     <div class="col">
     <label class="h6 mb-0 font-weight-bold text-success">Site</label>
     <input type="text" readonly class="form-control" name="site" value="{{$todos->initiator_site}}">
     </div>
     </div>
     <div class="form-row mb-4">
	   <div class="col">
	   <label class="h6 mb-0 font-weight-bold text-success">SLM Date Review</label>
	   <input type="date" readonly name="slmD"  value="{{$todos->slmD}}" class="form-control" placeholder="SLM date" required="required">
     </div>
	   <div class="col">
	   <label class="h6 mb-0 font-weight-bold text-success">SLM Name</label>
	   <input type="text" name="slmN" readonly value="{{$todos->slmN}}" class="form-control">
     </div>
	   <div class="col">
	   <label class="h6 mb-0 font-weight-bold text-success">SLM Comments</label>
		 <textarea  name="slmC" class="form-control" readonly>{{$todos->slmC}}</textarea>
     </div>
	   </div>
     <div class="form-row mb-4">
	   <div class="col">
	   <label class="h6 mb-0 font-weight-bold text-success">HOD Date Review</label>
	   <input type="date" name="hodD" readonly value="{{$todos->hodD}}" class="form-control" placeholder="HOD date" required="required">
     </div>
	   <div class="col">
	   <label class="h6 mb-0 font-weight-bold text-success">HOD Name</label>
	   <input type="text" name="hodN" readonly value="{{$todos->hodN}}" class="form-control">
     </div>
	   <div class="col">
	   <label class="h6 mb-0 font-weight-bold text-success">HOD Comments</label>
		 <textarea  name="hodC" readonly class="form-control">{{$todos->hodC}}</textarea>
     </div>
	   </div>
     <div class="form-row mb-4">
	   <div class="col">
	   <label class="h6 mb-0 font-weight-bold text-success">OP Date Review</label>
	   <input type="date" name="opD" readonly value="{{$todos->opD}}" class="form-control" placeholder="OP date" required="required">
     </div>
	   <div class="col">
	   <label class="h6 mb-0 font-weight-bold text-success">OP Name</label>
	   <input type="text" name="opN" readonly value="{{$todos->opN}}" class="form-control">
     </div>
	   <div class="col">
	   <label class="h6 mb-0 font-weight-bold text-success">OP Comments</label>
		 <textarea  name="opC" class="form-control" readonly>{{$todos->opC}}</textarea>
     </div>
	   </div>
     <div class="form-row mb-4">
	   <div class="col">
	   <label class="h6 mb-0 font-weight-bold text-success">MD/DFO Date Review</label>
	   <input type="date" name="mdD" readonly value="{{$todos->mdD}}" class="form-control" required="required">
     </div>
	   <div class="col">
	   <label class="h6 mb-0 font-weight-bold text-success">MD/DFO Name</label>
	   <input type="text" name="mdN" readonly value="{{$todos->mdN}}" class="form-control">
     </div>
	   <div class="col">
	   <label class="h6 mb-0 font-weight-bold text-success">MD/DFO Comments</label>
		 <textarea  name="mdC" class="form-control" readonly>{{$todos->mdC}}</textarea>
     </div>
	   </div>
	   @if($todos->status == "DFO approved" || $todos->status == "MD approved" )
     <span>Status: Approved</span>
     @endif
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
