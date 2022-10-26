@extends('layout.main')
@section('container')
  <section>
    <div id="main" class="main-content mt-12 flex-1 bg-gray-100 pb-24 md:mt-2 md:pb-5">
      <div class="bg-gray-800 pt-3">
        <div class="rounded-t-3xl bg-gradient-to-r from-blue-400 to-blue-900 p-4 text-2xl text-white shadow">
          <h1 class="pl-2 font-bold">{{ $title }}</h1>
        </div>
      </div>

      <div class="flex flex-wrap">
        <div class="w-full pl-10 pr-10">
          <table class="mt-5 w-full border">
            <thead>
              <tr class="border-b bg-gray-50">
                <th class="cursor-pointer border-r p-2 text-sm font-thin text-gray-500">
                  <div class="flex items-center justify-center">Waktu</div>
                </th>
                <th class="cursor-pointer border-r p-2 text-sm font-thin text-gray-500">
                  <div class="flex items-center justify-center">Voltase</div>
                </th>
                <th class="cursor-pointer border-r p-2 text-sm font-thin text-gray-500">
                  <div class="flex items-center justify-center">Arus</div>
                </th>
                <th class="cursor-pointer border-r p-2 text-sm font-thin text-gray-500">
                  <div class="flex items-center justify-center">Daya</div>
                </th>
                <th class="cursor-pointer border-r p-2 text-sm font-thin text-gray-500">
                  <div class="flex items-center justify-center">Suhu</div>
                </th>
                <th class="cursor-pointer border-r p-2 text-sm font-thin text-gray-500">
                  <div class="flex items-center justify-center">Api</div>
                </th>
                <th class="cursor-pointer border-r p-2 text-sm font-thin text-gray-500">
                  <div class="flex items-center justify-center">Asap</div>
                </th>
                <th class="cursor-pointer border-r p-2 text-sm font-thin text-gray-500">
                  <div class="flex items-center justify-center">Status</div>
                </th>
              </tr>
            </thead>

            <tbody>
              @foreach ($sensors as $s)
                @php
                  $P = $s->voltase * $s->arus;
                @endphp

                <tr class="border-b text-center text-sm text-black">
                  <td class="bg-grey-100 border-r p-2">{{ $s->updated_at->format('d/m/y H:i:s') }}</td>

                  <td class="@php if ($s->voltase > 239) { echo 'bg-red-300'; } elseif ($s->voltase < 209) { echo 'bg-blue-300'; } else { echo 'bg-grey-100'; } @endphp border-r p-2">{{ number_format($s->voltase) . ' V' }}</td>

                  <td class="{{ $s->arus > 4 ? 'bg-red-300' : 'bg-gray-100 ' }} border-r p-2">{{ number_format($s->arus, $s->arus > 1 ? '1' : '2', '.', ',') . ' A' }}</td>

                  <td class="{{ $P > 880 ? 'bg-red-300' : 'bg-gray-100 ' }} border-r p-2">{{ number_format($P, '0', '.', ',') . ' VA' }}</td>

                  <td class="{{ $s->temperatur > 50 ? 'bg-red-300' : 'bg-gray-100 ' }} border-r p-2">{{ number_format($s->temperatur) }} C&deg;</td>

                  <td class="{{ $s->api > 0 ? 'bg-red-300' : 'bg-gray-100 ' }} border-r p-2">{{ $s->api }}</td>

                  <td class="{{ $s->asap > 300 ? 'bg-red-300' : 'bg-gray-100 ' }} border-r p-2">{{ number_format($s->asap) }}</td>

                  @php
                    if ($s->temperatur > 50 && $s->asap > 300 && $s->api > 0) {
                        echo '<td class="border-r bg-red-400 p-2">Kebakaran Terdeteksi</td>';
                    } elseif ($P > 900) {
                        echo '<td class="border-r bg-amber-400 p-2">Penggunaan Listrik Tinggi</td>';
                    } else {
                        echo '<td class="border-r bg-green-400 p-2">Aman</td>';
                    }
                  @endphp
                </tr>
              @endforeach

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
@endsection
