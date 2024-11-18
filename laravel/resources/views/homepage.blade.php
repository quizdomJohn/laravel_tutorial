<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>This is a blade template</h1>
    <p>2+2 equals to {{2+2}}</p>
    <p>The current year is {{date('Y')}}</p>
    <p>My name is {{$name}} and they call me {{$catname}}</p> {{--? the values of variables are in the controller --}}
    <ul>
        @foreach ($zoo as $animal)
            <li>{{$animal}}</li>
        @endforeach
    </ul>
    <a href="/about">Go to the about page</a>
</body>
</html>