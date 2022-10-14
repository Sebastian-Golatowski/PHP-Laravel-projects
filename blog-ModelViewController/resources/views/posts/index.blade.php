<h1>Posts</h1>
@if (count($posts)>0)
    @foreach ($posts as $item)
    <div class="well" onclick="location.href='/posts/{{$item->id}}'">
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <img style="width: 60%" src="/storage/cover_images/{{$item->cover_image}}">
            </div>
            <div class="col-md-8 col-sm-8" >
                <h3><a href='/posts/{{$item->id}}'>{{$item->title}}</a></h3>
                <small>Written on {{$item->created_at}} by {{$item->user->name}}</small>
            </div>
        </div>
    </div>
    @endforeach

    <div id="pag">{{$posts->links()}}</div>
@else
    <p>No posts found</p>
@endif
@endsection




