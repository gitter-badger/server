<?php

Response::macro('apiSuccess', function($data, $code = 200)
{
	return Response::json($data, $code);
});

Response::macro('apiError', function($error, $code = 400)
{
	$error = (object) array('error' => $error);
	return Response::json($error, $code);
});

// return Response::apiSuccess($data);
// return Response::apiError(array('message' => 'failed!'));
