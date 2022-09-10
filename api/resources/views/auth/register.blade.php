<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta charset="UTF-8">
  <meta charset="utf-8">
  <title>Register | siListrik</title>
  <link rel="stylesheet" href="css/app.css">
</head>

<body class="body-bg min-h-screen px-2 pt-12 pb-6 md:px-0 md:pt-20" style="font-family:'Lato',sans-serif;">
  <header class="mx-auto max-w-lg">
    <a href="#">
      <h1 class="text-center text-4xl font-bold text-white">StartUp</h1>
    </a>
  </header>

  <main class="mx-auto my-5 max-w-lg rounded-lg bg-white p-8 shadow-2xl md:p-12" id="login-form">
    <section id="title">
      <h1 class="text-center text-gray-600">Registration Form</h1>
    </section>

    <section class="mt-5">
      @if (session('error'))
        <div class="text-center text-red-500">
          {{ session('error') }}
        </div>
      @endif
      <form class="flex flex-col" method="POST" action="/register">
        @csrf
        <input type="text" value="{{ old('username') }}" id="username" placeholder="Username" name="username" required @error('username') invalid @enderror
          class="mt-1 block w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm placeholder-slate-400 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500" />
        @error('username')
          <div class="text-pink-500">{{ $message }}</div>
        @enderror
        <input type="password" value="{{ old('password') }}" id="password" placeholder="Password" name="password" required @error('password') invalid @enderror
          class="mt-1 block w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm placeholder-slate-400 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500" />
        @error('password')
          <div class="text-pink-500">{{ $message }}</div>
        @enderror
        <button class="mt-5 rounded bg-blue-500 py-2 font-bold text-black shadow-lg transition duration-200 hover:bg-blue-700 hover:shadow-xl" type="submit">Register</button>
      </form>
      <a href="login" class="mt-2 text-center text-blue-500">login</a>
    </section>
  </main>
</body>

</html>
