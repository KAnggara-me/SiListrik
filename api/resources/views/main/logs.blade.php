@extends('layout.main')
@section('container')
	<section>
		<div class="main-content mt-12 bg-gray-100 pb-24 md:mt-2 md:pb-5" id="main">
			<div class="flex flex-wrap bg-gray-800 pt-3">
				<div class="w-full rounded-t-3xl bg-gradient-to-r from-blue-400 to-blue-900 p-4 text-2xl text-white shadow">
					<h1 class="w-full pl-2 font-bold">Logs</h1>
				</div>
			</div>

			<div class="flex flex-wrap">
				<div class="w-full md:pl-10 md:pr-10">
					<table class="mt-5 w-full border">
						<thead>
							@php
								$judul = ['Waktu', 'Penerima', 'Pesan', 'Type', 'Status', 'Keterangan'];
							@endphp
							<tr class="border-b bg-gray-700">
								@for ($i = 0; $i < count($judul); $i++)
									<th class="cursor-pointer border-r p-2 text-sm font-thin text-white">
										<div class="flex items-center justify-center">{{ $judul[$i] }}</div>
									</th>
								@endfor
							</tr>
						</thead>

						<tbody>
							@foreach ($logs as $log)
								<tr class="border-b border-gray-200 text-center text-xs text-black md:text-sm">
									<td class="bg-grey-100 border-r border-gray-200 p-2">
										{{ $log->updated_at->format('d/m/y H:i:s') }}
									</td>

									<td class="border-r border-gray-200 bg-gray-100 p-2">
										<a href="http://wa.me/{{ $log->phone_number }}">
											{{ $log->phone_number }}
										</a>
									</td>
									<td class="border-r border-gray-200 bg-gray-100 p-2">
										{{ preg_replace('/[^A-Za-z0-9\-]/', ' ', $log->message) }}
									</td>
									<td class="border-r border-gray-200 bg-gray-100 p-2">
										@if ($log->type == 'send_message_response')
											Pesan Keluar
										@elseif ($log->type == 'incoming_message')
											Pesan Masuk
										@endif
									</td>
									<td class="{{ $log->status == 'pending' ? 'bg-blue-300' : 'bg-green-400' }} border-r border-gray-200 p-2">
										{{ ucfirst($log->status) }}
									</td>
									<td class="border-r border-gray-200 bg-gray-100 p-2">
										{{ $log->webhook_msg }}
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
@endsection
