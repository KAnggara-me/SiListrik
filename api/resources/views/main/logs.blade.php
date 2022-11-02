@extends('layout.main')
@section('container')
    <section>
        <div id="main" class="main-content mt-12 bg-gray-100 pb-24 md:mt-2 md:pb-5">
            <div class="flex flex-wrap bg-gray-800 pt-3">
                <div class="w-full rounded-t-3xl bg-gradient-to-r from-blue-400 to-blue-900 p-4 text-2xl text-white shadow">
                    <h1 class="w-full pl-2 font-bold">Histori Sensor</h1>
                </div>
            </div>

            <div class="flex flex-wrap">
                <div class="w-full md:pl-10 md:pr-10">
                    <table class="mt-5 w-full border">
                        <thead>
                            @php
                                $judul = ['Waktu', 'Voltase', 'Arus', 'Daya', 'Suhu', 'Api', 'Asap', 'Status'];
                            @endphp
                            <tr class="border-b bg-gray-700">
                                @for ($i = 0; $i <= 7; $i++)
                                    <th class="cursor-pointer border-r p-2 text-sm font-thin text-white">
                                        <div class="flex items-center justify-center">{{ $judul[$i] }}</div>
                                    </th>
                                @endfor
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($sensors as $s)
                                @php
                                    $P = $s->voltase * $s->arus;
                                @endphp
                                <tr class="border-b border-gray-200 text-center text-xs text-black md:text-sm">
                                    <td class="bg-grey-100 border-r border-gray-200 p-2">
                                        {{ $s->updated_at->format('d/m/y H:i:s') }}</td>
                                    <td
                                        class="@php if ($s->voltase > 239) { echo 'bg-red-300'; } elseif ($s->voltase < 209) { echo 'bg-blue-300'; } else { echo 'bg-grey-100'; } @endphp border-r border-gray-200 p-2">
                                        {{ number_format($s->voltase) . ' V' }}</td>
                                    <td
                                        class="{{ $s->arus > 4 ? 'bg-red-300' : 'bg-gray-100 ' }} border-r border-gray-200 p-2">
                                        {{ number_format($s->arus, $s->arus > 1 ? '1' : '2', '.', ',') . ' A' }}</td>
                                    <td class="{{ $P > 880 ? 'bg-red-300' : 'bg-gray-100 ' }} border-r border-gray-200 p-2">
                                        {{ number_format($P, '0', '.', ',') . ' VA' }}</td>
                                    <td
                                        class="{{ $s->temperatur > 50 ? 'bg-red-300' : 'bg-gray-100 ' }} border-r border-gray-200 p-2">
                                        {{ number_format($s->temperatur) }} C&deg;</td>
                                    <td
                                        class="{{ $s->api > 0 ? 'bg-red-300' : 'bg-gray-100 ' }} border-r border-gray-200 p-2">
                                        {{ $s->api }}</td>
                                    <td
                                        class="{{ $s->asap > 300 ? 'bg-red-300' : 'bg-gray-100 ' }} border-r border-gray-200 p-2">
                                        {{ number_format($s->asap) }}</td>
                                    @php
                                        if ($s->temperatur > 50 && $s->asap > 300 && $s->api > 0) {
                                            echo '<td class="border-r border-gray-200 bg-red-400 p-2">Kebakaran Terdeteksi</td>';
                                        } elseif ($P > 900) {
                                            echo '<td class="border-r border-gray-200 bg-amber-400 p-2">Penggunaan Listrik Tinggi</td>';
                                        } elseif ($s->temperatur > 50) {
                                            echo '<td class="border-r border-gray-200 bg-orange-400 p-2">Temperatur Tinggi</td>';
                                        } elseif ($s->voltase > 239) {
                                            echo '<td class="border-r border-gray-200 bg-pink-400 p-2">Over Voltage</td>';
                                        } elseif ($s->api > 0) {
                                            echo '<td class="border-r border-gray-200 bg-rose-400 p-2">Api Terdeteksi</td>';
                                        } elseif ($s->asap > 300) {
                                            echo '<td class="border-r border-gray-200 bg-slate-400 p-2">Asap Terdeteksi</td>';
                                        } else {
                                            echo '<td class="border-r border-gray-200 bg-green-400 p-2">Aman</td>';
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
