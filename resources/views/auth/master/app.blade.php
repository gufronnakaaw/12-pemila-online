<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title')</title>
  <link rel="stylesheet" href="css/auth/main.css" />
</head>

<body class="d-flex text-center bg-secondary">

  @yield('content')

  <script>
    document.addEventListener('click', function (e) {
      if (e.target.className === 'close' || e.target.className === 'span-close') {
        document.querySelector('.alert-dismissible').style.display = 'none';
      }
    });
  </script>
</body>

</html>