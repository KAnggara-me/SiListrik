<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="UTF-8">
	<meta name="author" content="SiListrik">
	<meta name="description" content="SiListrik">
	<meta name="keywords" content="api,wa,listrik">
	<link href="css/app.css" rel="stylesheet">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	@env('local')
	<link href="css/all.min.css" rel="stylesheet">
	@endenv

	<link href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" rel="stylesheet">

	<title>{{ $title }} | SiListrik</title>

	@if ($active == 'home')
		<script src="js/Chart.bundle.min.js"></script>
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
		const xhttp = new XMLHttpRequest();
		const username = {{ Js::from(auth()->user()->username) }};
		const token = {{ Js::from(auth()->user()->token) }};
		const initStatus = {{ Js::from(auth()->user()->status) }};
		const url = 'api/v1/status/' + username + '/' + token;
		let status = initStatus;

		setInterval(function() {
			var xhr = new XMLHttpRequest();
			xhr.open("GET", url, true);
			xhr.setRequestHeader("Accept", "application/json");
			xhr.setRequestHeader("Authorization", "Bearer " + token);
			xhr.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					var data = JSON.parse(this.responseText);
					status = data.status;
				}
			};
			xhr.send();

			if (status != initStatus) {
				console.log('status berubah')
				if (status == 0) {
					console.log("User disconnected");
					window.location.href = "connect";
				} else {
					console.log("User connected");
					window.location.href = "home";
				}
			}
		}, 10000);
	</script>
</body>

</html>
