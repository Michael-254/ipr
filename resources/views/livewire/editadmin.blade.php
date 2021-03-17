
<div>
   <div class="card shadow mb-4">
   <div class="card-body">
   <a href="{{route('todo.supplier')}}" class="navbar-nav ml-auto">
    <span class="m-0 font-weight-bold text-primary navbar-nav ml-auto"><b>New supplier</b> </span>
  </a>
   <div class="table-responsive h9 mb-0 font-weight-bold text-red-700">
   <table class="table table-bordered"  width="100%" cellspacing="0">
   <thead class="text-success m-0 font-weight-bold">
   <td>Item</td>
   <td>Description</td>
   <td>UOM</td>
   <td>Required Qty</td>
   <td>Unit Price</td>
   <td>Total Price</td>
   <td>Budget Code</td>
   <td>Supplier</td>
   <td>Decision</td>
   </thead>
   @foreach($steps as $step)
   @if($step->decision == 'accept')
   <div wire:key="{{$step}}">
   <tr>
   <td><textarea  name="stepName[]"  placeholder="Item" rows="3" readonly>{{$step->step}}</textarea>
      <input  type="hidden" name="stepId[]" value="{{$step->id}}" ></td>
   <td><textarea  name="itemD[]"  placeholder="Description" rows="3" readonly>{{$step->description}}</textarea></td>
   <td><input type="text"  name="UOM[]"  value="{{$step->uom}}" readonly></td>
    <td><input type="number" step=0.1 name="quantityR[]" id="B{{$loop->index+1}}" oninput="calculate{{$loop->index+1}}();" value="{{$step->quantityR}}" placeholder="Required Quantity" required="required"></td>
    <td><input type="number" step=0.01 id="B{{$loop->index+16}}"  oninput="calculate{{$loop->index+1}}();" name="unitP[]" value="{{$step->unitP}}" placeholder="Unit Price"></td>
    <td><input  type="number" step=0.01 id="B{{$loop->index+33}}"  readonly name="answer[]" value="{{$step->totalP}}" class="txt" onkeyup='update_sum()' placeholder="Total Price"></td>
    <td><input  type="text" name="budget[]" required placeholder="Budget Code" value="{{$step->budget}}"></td>
    <td><select required name="supplier[]">
    <option>{{$step->supplier}}</option> 
    @foreach($supplier as $supp)
    @if($supp->level == 'allowed')
    <option>{{$supp->company}}</option> 
    @endif
    @endforeach
    </select></td>
    <td><select name="decision[]" >
    <option value="accept">Accept</option>
    <option value="reject">Reject</option>
   </select></td>
 </tr>
    </div>
    @endif
    @endforeach
    </table>
    </div>
    </div>
    </div>
 </div>
