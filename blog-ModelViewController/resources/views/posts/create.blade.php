@section('content')
    <h1>Create Post</h1>
    {!! Form::open(['action'=>'App\Http\Controllers\PostsController@store','method'=>'POST',"enctype"=>"multipart/form-data"]) !!}
        <div class="form-group">
            {{FORM::label('title','Title')}}
            {{FORM::text('title','',['class'=>'form-control','placeholder'=>'Title'])}}
            {{FORM::label('body','Body')}}
            {{FORM::textarea('body','',['class'=>'form-control','placeholder'=>'Post Text'])}}
        </div>
        <div class="form-group">
            {!! Form::file("cover_image") !!}
        </div>
        {!! Form::submit('submit', ['class'=>'btn btn-dark btn-dg']) !!}
    {!! Form::close() !!}
@endsection