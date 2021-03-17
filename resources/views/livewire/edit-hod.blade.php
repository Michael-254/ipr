
<div>
   <div class="card shadow mb-4">
   <div class="card-body">
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
      <input  type="hidden" name="stepId[]" value="{{$step->id}}" ></textarea></td>
   <td><textarea rows="3" readonly>{{$step->description}}</textarea></td>
   <td><input value="{{$step->uom}}" readonly/></td>
    <td><input type="number" step=0.1 name="quantityR[]" id="B{{$loop->index+1}}" readonly oninput="calculate{{$loop->index+1}}();" value="{{$step->quantityR}}" placeholder="Required Quantity" required="required"></td>
    <td><input type="number" step=0.01 id="B{{$loop->index+16}}" readonly  oninput="calculate{{$loop->index+1}}();" name="unitP[]" value="{{$step->unitP}}" placeholder="Unit Price"></td>
    <td><input  type="number" step=0.01 id="B{{$loop->index+33}}" readonly name="answer[]" value="{{$step->totalP}}" class="txt" onkeyup='update_sum()' placeholder="Total Price"></td>
    <td><input value="{{$step->budget}}" readonly/></td>
    <td><textarea rows="3" readonly>{{$step->supplier}}</textarea></td>
    <td><select name='decision[]' >
    <option value="accept">Accept</option>
    <option value="reject">Reject</option>
    </td>
    <tr>
    </div>
    @endif
    @endforeach
    </table>
    </div>
    </div>
    </div>
 </div>
