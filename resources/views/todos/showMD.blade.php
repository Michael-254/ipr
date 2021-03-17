@extends('todos.layout')

@section('content')
<div class="container-fluid">

          <!-- Page Heading -->
    <form class="text-center border border-light p-5" action="{{route('todo.updateMD',$todos->id)}}" method="post" enctype="multipart/form-data">
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
      @livewire('edit-hod',['steps' => $todos->step])
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
      <label class="h6 mb-0 font-weight-bold text-success">Decision</label>
      <select class="form-control" name="status" required="required">
      <option value="">Select Status</option><option value="MD approved">MD approved</option>
      <option value="MD declined">MD declined</option><option value="DFO approved">DFO approved</option>
      <option value="DFO declined">DFO declined</option></select>
      </div>
	   <div class="col">
	   <label class="h6 mb-0 font-weight-bold text-success">Date Review</label>
	   <input type="date" name="mdD" readonly value="{{ date('Y-m-d') }}" class="form-control" required="required">
     </div>
	   <div class="col">
	   <label class="h6 mb-0 font-weight-bold text-success">Name</label>
	   <input type="text" name="mdN" readonly value="{{$user->name}}" class="form-control">
     </div>
	   <div class="col">
	   <label class="h6 mb-0 font-weight-bold text-success">Comments</label>
		 <textarea  name="mdC" class="form-control">{{$todos->mdC}}</textarea>
     </div>
	   </div>
     <div class="form-group">
     <div class="col-xl-2">
     <input type="file" class="justify-content-center" name="image[]"  multiple='multiple'>
     </div>
     </div>
     <input type="hidden" readonly class="form-control" name="email" value="{{$todos->email}}">
     <input type="hidden" readonly class="form-control" name="slmM" value="{{$todos->slmM}}">
     <input type="hidden" readonly class="form-control" name="hodM" value="{{$todos->hodM}}">
     <input type="hidden"  readonly class="form-control" name="opM" value="{{$todos->opM}}">
     <button class="btn btn-success " type="submit" name="submit" value="Submit">Update</button>
     <div class="form-group">
     <div class="col-xl-2">
     @livewire('image',['images' => $todos->image])
     </div>
     </div>
</form>
</div>
@endsection
