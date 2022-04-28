<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
<<<<<<< HEAD
  <title>@yield('title') - App Laravel 9</title>

  <link rel="shortcut icon" href="{{ url('images/favicon.ico') }}" type="image/png">

=======

  <link rel="shortcut icon" href="{{ url('images/favicon.ico') }}" type="image/png">

  <title>@yield('title') Aplicação Laravel</title>

>>>>>>> 255c8f2f6977e27f7525c8c7f0930cd00ce343b4
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
  <div class="container mx-auto px-4 py-8">
    @yield('content')
  </div>
</body>
</html>