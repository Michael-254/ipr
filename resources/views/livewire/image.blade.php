<div>
    @foreach($images as $image)
    <div>
    <a href="{{route('todo.file',$image->id)}}" target="_blank">{{$image->image}}</a>
  </div>
    @endforeach
</div>
