<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta name="author" content="SiListrik">
  <link rel="stylesheet" href="css/app.css">
  <meta name="description" content="SiListrik">
  <meta name="keywords" content="api,wa,listrik">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
  <title>{{ $title }} | SiListrik</title>

  @if ($title == 'home')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js" integrity="sha256-xKeoJ50pzbUGkpQxDYHD7o7hxe0LaOGeguUidbq6vis=" crossorigin="anonymous"></script>
  @endif

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
  <script src="js/app.js"></script>

  <script>
    function getStatus() {
      const xhttp = new XMLHttpRequest();
      xhttp.onload = function() {}
    }
    const status = {{ Js::from(auth()->user()->status) }};

    if (status == 1)
      console.log('user aktif');
    else
      console.log('user tidak aktif');
  </script>

  {{-- <script>
    var qrCode = document.getElementById("qrCode");
    var qrCodeValue = "";

    var token = {{ Js::from(auth()->user()->token) }};
    var id = {{ Js::from(auth()->user()->username) }};
    var status = {{ Js::from(auth()->user()->status) }};

    setInterval(function() {
      // Create a ajax Object
      var xhr = new XMLHttpRequest();
      xhr.open("GET", "/status", true);
      xhr.setRequestHeader("Accept", "application/json");
      xhr.setRequestHeader("Authorization", "Bearer " + id);

      // CHeck if the ajax object is ready
      xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var data = JSON.parse(this.responseText);
          status = data.status;
          console.log(status)
          console.log(typeof status)
        }
      };
      xhr.send();

      if (status == 0) {
        console.log("Not OK");
        getqr();
      } else {
        console.log("OK");
        // window.location.href = "home";
      }

    }, 2000);

    function getqr(params) {
      console.log("Running");
      // // Create a a jax Object
      // var xhr1 = new XMLHttpRequest();

      // xhr1.open("GET", "/qr", true);
      // xhr1.setRequestHeader("Accept", "application/json");
      // xhr1.setRequestHeader("Authorization", "Bearer " + token);

      // // CHeck if the ajax object is ready
      // xhr1.onreadystatechange = function() {
      //   if (this.readyState == 4 && this.status == 200) {
      //     qrCode.innerHTML = xhr1.responseText;
      //   }
      // };
      // console.log(xhr1.responseText);
      // xhr1.send();
    }
  </script> --}}

</body>

</html>
