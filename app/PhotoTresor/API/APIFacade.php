<?php
namespace PhotoTresor\API;

use Illuminate\Support\Facades\Facade;

class APIFacade extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return 'API'; }

}
