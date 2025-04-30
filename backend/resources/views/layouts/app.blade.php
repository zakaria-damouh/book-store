<!DOCTYPE html>
<html>
<head>
    <title>Bookstore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('partials.nav') <!-- if you have nav -->
    <div class="py-4">
        @yield('content')
    </div>
</body>
</html>
