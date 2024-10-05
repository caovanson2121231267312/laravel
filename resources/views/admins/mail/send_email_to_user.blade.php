<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $mailData['title'] }}</title>

    <style>
        .red {
            color: red;
            font-weight: 500;
        }

        .blue {
            color: blue;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <div>
        <p class="red">Kính gửi: {{ $mailData['name'] }}</p>
    </div>
    <div style="margin-top: 50px">
        <p>{{ $mailData['content'] }}</p>
    </div>

    <div>
        <p class="red">cảm ơn: {{ $mailData['name'] }}</p>
    </div>
</body>

</html>
