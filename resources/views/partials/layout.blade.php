<!DOCTYPE html>
<html lang="en" data-theme="nord">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
</head>

<body>
    @include('partials.nav')
    <div class="flex">
        <ul class="menu bg-base-200 rounded-box">
            @foreach(App\Models\Category::where('parent_id', null)->get() as $category)
               @include('partials.subcategory')
            @endforeach
        </ul>
        <div>
            @yield('content')
        </div>
    </div>
</body>

</html>
