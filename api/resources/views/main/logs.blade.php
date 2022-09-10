@extends('layout.main')
@section('container')
  <div class="mt-10 w-full bg-slate-300 p-10">
    <div class="m-10 bg-red-100">
      <h1 class="text-2xl font-bold">{{ $title }}</h1>
      <p class="text-sm">This is the {{ $active }} page</p>
    </div>
  </div>
@endsection
