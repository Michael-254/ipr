@extends('todos.layout')

@section('content')
<div class="container-fluid">

          <!-- Page Heading -->
    <form class="text-center border border-light p-5" action="{{route('todo.update',$todos->id)}}" method="post" enctype="multipart/form-data">
    @csrf
     @method('patch')
     @include('layouts.flash')
     <p class="h2 mb-4 text-success">Internal Purchase Requisition Form</p><hr>
     <div class="form-row mb-4">
          <div class="col-xl-1">
         <label class="h8 mb-0 font-weight-bold text-danger">Ref No:</label>
      <input class="form-control" readonly name="ref_no" value="{{$todos->id}}">
      </div>
      <div class="col-xl-3">
     <label class="h8 mb-0 font-weight-bold text-primary">Site:</label>
     <input class="form-control" readonly name="site" value="{{$todos->initiator_site}}">
     </div>
     </div>
      @livewire('editstep',['steps' => $todos->step])
     <div class="form-row mb-4">
       <div class="col">
       <label class="h6 mb-0 font-weight-bold text-success">Person To review</label>
       <input type="text" readonly class="form-control" name="reviewer">
       </div>
       <div class="col">
       <label class="h6 mb-0 font-weight-bold text-success">Date</label>
       <input type="text"  readonly class="form-control" name="initiatedDate" value="{{$todos->date_initiated}}">
       </div>
     <div class="col">
     <label class="h6 mb-0 font-weight-bold text-success">VAT</label>
     <select class="form-control" name="VAT">
       <option>{{$todos->vat}}</option>
     <option value="">VAT status</option><option value="VAT Inclusive">VAT Inclusive</option><option value="VAT Excluded">VAT Excluded</option></select>
     </div>
     <div class="col">
     <label class="h6 mb-0 font-weight-bold text-success">Sum</label>
     <span class="text-danger" id="sum-field">0</span>
     </div>
     <div class="col">
     <label class="h6 mb-0 font-weight-bold text-success">Currency Type</label>
     <select class="form-control" name="currency">
     <option>{{$todos->currency}}</option><option>Kshs</option><option>UGX </option><option>TZS</option>
     <option>USD</option></select>
     </div>
     </div>
     <div class="form-row mb-4">
     <div class="col">
		 <label class="h6 mb-0 font-weight-bold text-success">Expected lead Time</label>
     <input type="number" name="leadT" class="form-control" value="{{$todos->leadT}}" placeholder="In days">
     </div>
     <div class="col">
		 <label class="h6 mb-0 font-weight-bold text-success">Explanation if Urgent</label>
		 <textarea class="form-control" name="urgencyE"  rows="2">{{$todos->explanation}}</textarea>
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
	   <input type="date" name="slmD" readonly value="{{$todos->slmD}}" class="form-control" placeholder="SLM date" required="required">
     </div>
	   <div class="col">
	   <label class="h6 mb-0 font-weight-bold text-success">SLM Name</label>
	   <input type="text" name="slmN" readonly value="{{$todos->slmN}}" class="form-control">
     </div>
	   <div class="col">
	   <label class="h6 mb-0 font-weight-bold text-success">SLM Comments</label>
		 <textarea  name="slmC" class="form-control" readonly >{{$todos->slmC}}</textarea>
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
		 <textarea  name="hodC" class="form-control" readonly >{{$todos->hodC}}</textarea>
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
		 <textarea  name="opC" class="form-control" readonly >{{$todos->opC}}</textarea>
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
     <div class="form-group">
     <div class="col-xl-2">
     <input type="file" class="justify-content-center" name="image[]"  multiple='multiple'>
     </div>
     </div>
     <button class="btn btn-success " type="submit" name="submit" value="Submit">Update</button><br>
     <a  href="{{route('todo.rejected',$todos->id)}}">Rejected Items</a>
     <div class="form-group">
     <div class="col-xl-2">
     @livewire('image',['images' => $todos->image])
     </div>
     </div>

</form>
</div>
@endsection
