<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel PHP Framework</title>
    <style>
        @import url(//fonts.googleapis.com/css?family=Lato:300,400,700);

        body {
            margin:0;
            font-family:'Lato', sans-serif;
            text-align:center;
        }
    </style>
</head>
<body>

   <h2>S3 Example</h2>

    @if(isset($images))
    @foreach ($images as $image)
       <img src="{{$image}}">
    @endforeach
    @else
        <p>No images in your bucket</p>
    @endif

    {{ Form::open(array('method' => 'post','files'=>true)) }}
    {{ Form::token() }}
    {{ Form::file('image') }}
    {{ Form::submit('Submit') }}
    {{ Form::close() }}
</body>
</html>
