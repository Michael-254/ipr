<div class="container" style="text-align: center">
  <h3>Comments</h3>
  <input type="text" name="" placeholder="whats on your mind" wire:model="newComment">
  <button wire:click='addComment'>Add</button>
</div>
<div class="container" style="text-align: center">
<table class="table-responsive">
  @foreach($comment as $c)
  <tr>
      <td>
        {{$c['creator']}} </td> <td> {{$c['created_at']}}
    </td>
  <td class="text-primary">
    {{$c['body']}}
</td>
@endforeach
</table>
{{$newComment}}
</div>
