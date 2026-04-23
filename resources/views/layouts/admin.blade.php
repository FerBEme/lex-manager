@props([
    'title' => config('app.name'),
    'breadcrumbs' => [],
])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://kit.fontawesome.com/03ed6c0fda.js" crossorigin="anonymous"></script>
</head>
<body>
    

    @include('layouts.includes.admin.navigation')

    @include('layouts.includes.admin.sidebar')

<div class="p-4 sm:ml-64">
    <div class="mt-14 flex items-center">
        @include('layouts.includes.admin.breadcrumb')
        @isset($action)
            <div class="ml-auto">{{ $action }}</div>
        @endisset
    </div>
    {{ $slot }}
</div>

</body>
</html>