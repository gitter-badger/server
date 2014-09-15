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
