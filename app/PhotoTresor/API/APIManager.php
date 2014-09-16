<?php
namespace PhotoTresor\API;

use Illuminate\Http\JsonResponse;

class APIManager {

	protected $response;
	protected $data;

	public function __construct(JsonResponse $response)
	{
		$this->response = $response;
	}

	public function success($code = 200)
	{
		if($code < 200 or $code >= 300)
		{
			throw Exception();
		}

		if(!is_null($this->data))
		{
			$this->response->setData($this->data);
		}

		$this->response->setStatusCode($code);

		return $this->response;
	}

	public function withResource(array $resource)
	{
		$this->data = $resource;

		return $this;
	}

}
///*
// * Request
// */
//$expandable = API::expand();
//$fields = API::fields();

///*
// * Response
// */
//API::success();
//API::success(201)->resource($data);
//API::success()->data($data); // same as resource
//
//API::error();
//API::error(401)->message("Can't touch this");
//API::error()->type('PDOException');
//API::error()->type($e); // Where $e is an Exception, set type only
//API::error()->exception($e); // Where $e is an Exception, sets type and message
