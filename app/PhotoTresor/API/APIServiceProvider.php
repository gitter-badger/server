<?php
namespace PhotoTresor\API;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\ServiceProvider;

class APIServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return Api
	 */
	public function register()
	{
		$this->app->bindShared('API', function($app)
		{
			return new APIManager(new JsonResponse());
		});
	}
}