@extends('todos.layout')
@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <form class="text-center border border-light p-5" action="{{route('todo.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    @include('layouts.flash')
    <p class="h2 mb-4 text-success">New Internal Purchase Requisition Form</p>
    @livewire('step')
    <table class="table" width="100%" cellspacing="0">
      <thead>
        <td><label class="h6 mb-0 font-weight-bold text-success">Person To review</label></td>
        <td><label class="h6 mb-0 font-weight-bold text-success">Date</label></td>
        <td><label class="h6 mb-0 font-weight-bold text-success">VAT</label></td>
        <td><label class="h6 mb-0 font-weight-bold text-success">Sum</label></td>
        <td><label class="h6 mb-0 font-weight-bold text-success">Currency Type</label></td>
      </thead>
      <tr>
        <td>
          <select class="form-control" name="reviewer" required>
            <option value="{{$user->supervisor}}">{{$user->supervisor}}</option>
            <option value="{{$user->secondSup}}">{{$user->secondSup}}</option>
          </select>
        </td>
        <td>
          <input type="date" class="form-control" name="initiatedDate" value="{{ date('Y-m-d') }}" readonly>
        </td>
        <td>
          <select class="form-control" name="VAT">
            <option value="">VAT status</option>
            <option value="VAT Inclusive">VAT Inclusive</option>
            <option value="VAT Excluded">VAT Excluded</option>
          </select>
        </td>
        <td><span class="text-danger" id="sum-field">0</span></td>
        <td>
          <select class="form-control" name="currency">
            <option value="">Select Currency</option>
            <option value="Kshs">Kshs</option>
            <option value="UGX">UGX </option>
            <option value="TZS">TZS</option>
            <option value="USD">USD</option>
          </select>
        </td>
      </tr>
    </table>
    <table class="table" width="100%" cellspacing="0">
      <thead>
        <td><label class="h6 mb-0 font-weight-bold text-success">Expected lead Time</label></td>
        <td><label class="h6 mb-0 font-weight-bold text-success">Explanation if Urgent</label></td>
        <td><label class="h6 mb-0 font-weight-bold text-success">Prepared By</label></td>
        <td><label class="h6 mb-0 font-weight-bold text-success">Department</label></td>
        <td><label class="h6 mb-0 font-weight-bold text-success">Site</label></td>
      </thead>
      <tr>
        <td>
          <input class="form-control" type="text" name="leadT" placeholder="In days">
        </td>
        <td>
          <textarea class="form-control" name="urgencyE" placeholder="Message" rows="2"></textarea>
        </td>
        <td>
          <input class="form-control" readonly name="userN" value="{{$user->name}}">
        </td>
        <td>
          <select class="form-control" name="department" required>
            <option value="">Select Department</option>
            <option value="IT">IT</option>
            <option value="Accounts">Accounts </option>
            <option value="HR">HR</option>
            <option value="Communications">Communications</option>
            <option value="Forestry">Forestry</option>
            <option value="Miti Magazines">Miti Magazine</option>
            <option value="Operations">Operations</option>
            <option value="M&E">M&E</option>
          </select>
        </td>
        @if($user->special)
        <td>
          <select class="form-control" name="site" required>
            <option value="{{$user->site}}">{{$user->site}}</option>
            <option value="7 Forks">7 Forks</option>
          </select>
        </td>
        @else
        <td>
          <input type="text" class="form-control" readonly name="site" value="{{$user->site}}">
        </td>
        @endif
      </tr>
    </table>
    <div class="form-group">
      @if(auth()->user()->site == 'Nyongoro' || auth()->user()->site == 'Kiambere' || auth()->user()->site == '7 Forks')
      <div class="col-xl-2">
        <label class="h6 mb-0 font-weight-bold text-success">Site Reviewer</label>
        <select class="form-control" name="site_inspector" required>
          <option value="SLM">SLM</option>
          <option value="SLO">SLO</option>
        </select>
      </div>
      @else
      <input type="hidden" name="site_inspector" value="0">
      @endif
    </div>
    <div class="form-group">
      <div class="col-xl-2">
        <input type="file" class="justify-content-center" name="image[]" multiple='multiple'>
      </div>
    </div>
    <input type="hidden" readonly class="form-control" name="email" value="{{$user->email}}">
    <input type="hidden" readonly class="form-control" name="slmM" value="">
    <input type="hidden" readonly class="form-control" name="hodM" value="">
    <input type="hidden" readonly class="form-control" name="opM" value="">
    <button class="btn btn-success " type="submit" name="submit" value="Submit">Submit</button>
  </form>
</div>
@endsection