@section('content')
    <h1>Edit Post</h1>
    {!! Form::open(['action'=>['App\Http\Controllers\PostsController@update',$post->id],'method'=>'PUT',"enctype"=>"multipart/form-data"]) !!}
        <div class="form-group">
            {{FORM::label('title','Title')}}
            {{FORM::text('title',$post->title,['class'=>'form-control','placeholder'=>'Title'])}}
            {{FORM::label('body','Body')}}
            {{FORM::textarea('body',$post->body,['class'=>'form-control','placeholder'=>'Post Text'])}}
        </div>
        <div class="form-group">
            {!! Form::label('cover_image', 'change cover image') !!}<br>
            <img style="width: 20%" src="/storage/cover_images/{{$post->cover_image}}"><br>

            {!! Form::file("cover_image") !!}
        </div>
        {!! Form::submit('submit', ['class'=>'btn btn-dark btn-dg']) !!}
    {!! Form::close() !!}
    <br><br><br>
@endsection