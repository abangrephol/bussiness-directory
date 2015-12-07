<?php namespace Modules\appecommerce\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Events;
class AppEcommerceServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//

	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}
    public function boot()
    {

        //\Event::subscribe('\Modules\appecommerce\HTTP\Controllers\AppEcommerceController');
    }
}
