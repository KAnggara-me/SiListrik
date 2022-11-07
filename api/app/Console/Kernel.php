<?php

namespace App\Console;

use Exception;
use App\Models\Status;
use App\Models\SensorLog;
use Illuminate\Support\Facades\Storage;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
	{
		// Remove unused file
		$schedule->call(function () {
			$unusedFile = Status::select('images')->where('isUsage', 0);
			$toDelete = $unusedFile->get();

			$delete = [];
			foreach ($toDelete as $value) {
				$delete[] = $value->images;
			}
			$deleted =  Storage::delete($delete);
			if ($deleted) {
				$unusedFile->delete();
			}
		});

		// Generate image file
		$schedule->call(function () {
			$data = SensorLog::orderBy('updated_at', 'desc')->first();
			$time = time();
			$image = getImage($time);
			$path = "images/" .  $time . '.' . 'jpg';
			$filename = public_path($path);
			$isExist = file_exists($filename);

			if (!$isExist || !$image) {
				throw new Exception("File Not Found", 1);
			} else {
				$status = new Status();
				$status->api = $data->api;
				$status->arus = $data->arus;
				$status->asap = $data->asap;
				$status->voltase = $data->voltase;
				$status->temperatur = $data->temperatur;
				$status->kelembaban = $data->kelembaban;
				$status->images = $path;
				$status->save();
			}
		});
	}

	/**
	 * Register the commands for the application.
	 *
	 * @return void
	 */
	protected function commands()
	{
		$this->load(__DIR__ . '/Commands');
		require base_path('routes/console.php');
	}
}
