<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p>
        A new message has arrived from <a href="mailto:{{ $email }}">{{ $first_name }} {{ $last_name }}</a>
    </p>
    <p>
        {!! nl2br(e($body)) !!}
    </p>
</body>
</html>