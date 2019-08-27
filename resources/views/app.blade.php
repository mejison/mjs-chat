<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet" />
  <meta name="theme-color" content="#6e5694" />
  <title>Laravel</title>
</head>

<body>
  <div id="app"></div>
  <script src="{{ mix('/js/app.js') }}"></script>
</body>

</html>