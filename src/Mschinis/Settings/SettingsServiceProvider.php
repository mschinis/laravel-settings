<?php namespace Mschinis\Settings;

use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot(){
		$this->package('mschinis/settings');

	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register(){
		$this->registerSetting();
	}
    private function registerSetting(){
        $this->app['setting'] = $this->app->share(function($app){
           return new SettingsCore();
        });
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

}
