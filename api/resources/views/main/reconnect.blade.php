@extends('layout.main')
@section('container')
  @if ($show)
    <div id="main" class="main-content mt-12 flex-1 rounded-xl bg-slate-300 pb-24 md:mt-2 md:pb-5">
      <div class="mt-2 flex flex-grow flex-row flex-wrap content-center items-center">
        <div class="hover:shadow-light-blue m-5 content-center items-center rounded-lg border-transparent bg-white shadow-xl">
          <div class="rounded-tl-lg rounded-tr-lg border-b-2 border-gray-300 bg-gradient-to-b from-gray-300 to-gray-100 p-2 text-gray-800">
            <h5 class="text-center font-bold text-gray-600">Reconnect Please</h5>
          </div>
          <div class="content-center items-center object-center p-5 sm:max-w-sm md:max-w-md">
            <div id="qrCode">
              {!! QrCode::size(300)->generate($qr) !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  @endif
@endsection
