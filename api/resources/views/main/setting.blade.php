@extends('layout.main')
@section('container')
	<section>
		<div id="main" class="main-content mt-12 bg-gray-100 pb-24 md:mt-2 md:pb-5 ml-10">
			<div class="bg-gray-800 pt-3">
				<div class="rounded-t-3xl bg-gradient-to-r from-blue-400 to-blue-900 p-4 text-2xl text-white shadow">
					<h1 class="pl-2 font-bold">{{ $title }}</h1>
				</div>
			</div>

			<div class="w-full pl-10 pr-10">
				@if (session('success'))
					<div class="text-center text-green-500 pt-5 text-lg font-bold">
						{{ session('success') }}
					</div>
				@endif

				<form class="flex flex-col" method="POST" action="/setting">
					@csrf
					<table class="mt-5 w-full">
						<tr class="p-4">
							<th class="cursor-pointer">
								<label for="admin" class="cursor-pointer">No. Admin</label>
							</th>
							<td class="pl-6 pr-2">
								<input type="number" id="admin" name="admin" value="{{ $settings->admin }}"
									@error('admin') invalid @enderror
									class="mt-1 block w-full rounded-md  border border-slate-300 bg-white px-3 py-2 text-sm placeholder-slate-400 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500" />
							</td>
						</tr>

						<tr>
							<th class="cursor-pointer">
								<label for="daya" class="cursor-pointer">Daya Terpasang</label>
							</th>
							<td class="pl-6 pr-2">
								<input type="number" id="daya" name="daya" value="900" required @error('daya') invalid @enderror
									readonly
									class="mt-1 block w-full rounded-md  border border-slate-300 bg-white px-3 py-2 text-sm placeholder-slate-400 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500" />
							</td>
							<td class="cursor-pointer">
								<label for="daya" class="cursor-pointer">VA</label>
							</td>
						</tr>

						<tr>
							<th class="cursor-pointer">
								<label for="limit" class="cursor-pointer">Limit Daya</label>
							</th>
							<td class="pl-6 pr-2">
								<input type="number" value="{{ $settings->limit }}" id="limit" name="limit" required
									@error('limit') invalid @enderror
									class="mt-1 block w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm placeholder-slate-400 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500" />
							</td>
							<td class="cursor-pointer">
								<label for="limit" class="cursor-pointer">VA</label>
							</td>
						</tr>

						<tr>
							<th class="cursor-pointer">
								<label for="tmax" class="cursor-pointer">Temperatur Max</label>
							</th>
							<td class="pl-6 pr-2">
								<input type="number" value="{{ $settings->tmax }}" id="tmax" name="tmax" required
									@error('tmax') invalid @enderror
									class="mt-1 block w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm placeholder-slate-400 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500" />
							</td>
							<td class="cursor-pointer">
								<label for="tmax" class="cursor-pointer">&deg;C</label>
							</td>
						</tr>

						<tr>
							<th class="cursor-pointer">
								<label for="asap" class="cursor-pointer">Limit Asap</label>
							</th>
							<td class="pl-6 pr-2">
								<input type="number" value="{{ $settings->asap }}" id="asap" name="asap" required
									@error('asap') invalid @enderror
									class="mt-1 block w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm placeholder-slate-400 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-1 focus:ring-sky-500" />
							</td>
						</tr>
					</table>

					<button
						class="mt-5 rounded bg-blue-500 py-2 font-bold text-white shadow-lg transition duration-200 hover:bg-blue-700 hover:shadow-xl"
						type="submit">Save</button>
				</form>

			</div>
		</div>
	</section>
@endsection
