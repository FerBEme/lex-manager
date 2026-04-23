<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    

    @include('layouts.includes.admin.navigation')

    @include('layouts.includes.admin.sidebar')

<div class="p-4 sm:ml-64 mt-14">
    {{ $slot }}
</div>

</body>
</html>