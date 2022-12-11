<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Bootstrap services.
	 *
	 * @return void
	 */
	public function boot()
	{
		// Use @selected if true return selected
		Blade::directive('selected', function ($condition) {
			return "<?php if({$condition}): echo 'selected'; endif; ?>";
		});


		// Use @checked if true return checked
		Blade::directive('checked', function ($condition) {
			return "<?php if({$condition}): echo 'checked'; endif; ?>";
		});

		// Use @disabled if true return disabled
		Blade::directive('disabled', function ($condition) {
			return "<?php if({$condition}): echo 'disabled'; endif; ?>";
		});

	}
}
