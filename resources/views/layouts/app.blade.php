<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Test</title>
  <link rel="stylesheet" href="/css/app.css">
</head>
<body>
  @include('inc.navbar')

  <div class="container">
    @yield('content')
  </div>

  @include('inc.footer')
</body>
</html>