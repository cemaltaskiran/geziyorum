<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>You have been punished</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css"crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>You have been punished until <strong>{{$user->getBan()->timeout}}</strong></h3>
            </div>
            <div class="col-md-12">
                <strong>Reason:</strong> {{$user->getBan()->complaint->name}}
            </div>
            <div class="col-md-12">
                <strong>Message:</strong> {{$user->getBan()->message}}
            </div>
        </div>
    </div>
</body>
</html>