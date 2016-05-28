<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <title>@yield('title')</title>
</head>
<body>
    <script src="/js/jquery-1.12.4.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <div class="row">
        <div class="col-md-2">
            <ul class="list-group">
                @include('layouts.blocks.leftMenu')
            </ul>
        </div>
        <div class="col-md-10">
            <ol class="breadcrumb">
                @include('layouts.blocks.breadcrumbs')
            </ol>
            @yield('content')
        </div>
    </div>

</body>
</html>