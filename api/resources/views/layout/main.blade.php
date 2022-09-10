<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="author" content="name">
  <meta name="description" content="description here">
  <meta name="keywords" content="keywords,here">
  {{-- @if (auth()->user()->status === 0)
    <meta http-equiv='refresh' content='20'>
  @endif --}}
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
  <link rel="stylesheet" href="css/app.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js" integrity="sha256-xKeoJ50pzbUGkpQxDYHD7o7hxe0LaOGeguUidbq6vis=" crossorigin="anonymous"></script>

  <title>{{ $title }} | SiListrik</title>
  @vite('resources/css/app.css')
</head>

<body class="mt-12 bg-gray-800 font-sans leading-normal tracking-normal">

  @include('layout.header')

  <main>
    <div class="flex flex-col md:flex-row">
      @include('layout.navbar')
      @yield('container')
    </div>
  </main>

  <script src="js/script.js"></script>
  @vite('resources/js/app.js')
  <script src="js/app.js"></script>

  <script>
    var qrCode = document.getElementById("qrCode");
    var qrCodeValue = "";

    var token = {{ Js::from(auth()->user()->token) }};
    var id = {{ Js::from(auth()->user()->username) }};

    setInterval(function() {
      // Create a ajax Object
      var xhr = new XMLHttpRequest();

      xhr.open("GET", "/qr", true);
      xhr.setRequestHeader("Accept", "application/json");
      xhr.setRequestHeader("Authorization", "Bearer " + token);

      // CHeck if the ajax object is ready
      xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          qrCode.innerHTML = xhr.responseText;
        }
      };

      xhr.send();
    }, 20000);
  </script>

</body>

</html>
