<?php

App::error(function(PhotoTresor\Validators\ValidationException $exception)
{
    $errorResponse = [
        'message' => $exception->getMessage(),
        'errors' => $exception->getErrors()
    ];

    return Response::json($errorResponse, 422);
});
