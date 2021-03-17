<div>
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
   </thead>
   @foreach($steps as $step)
   @if($step->decision == 'accept')
   <div wire:key="{{$step}}">
   <tr>
   <td>{{$step->step}}</td>
   <td>{{$step->description}}</td>
   <td>{{$step->uom}}</td>
    <td>{{$step->quantityR}}</td>
    <td>{{$step->unitP}}</td>
    <td><input  type="number" step=0.01 id="B{{$loop->index+33}}" readonly name="answer[]" value="{{$step->totalP}}" class="txt" onkeyup='update_sum()' placeholder="Total Price"></td>
    <td>{{$step->budget}}</td>
    <td>{{$step->supplier}}</td>
    <tr>
    </div>
    @endif
    @endforeach
    </table>
 </div>
