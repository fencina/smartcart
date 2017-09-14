<?php

namespace App\Traits;

trait ApiResponseExceptionHandler
{
    public function buildApiResponseForDefaultException($exception)
    {
        $response = [
            'error' => class_basename($exception)
        ];

        $statusCode = method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500;
        return [$response, $statusCode];
    }

    public function buildApiResponseForValidationException($exception)
    {
        $response = [
            'error' => class_basename($exception),
            'data' => $exception->validator->errors()->getMessages()
        ];

        return [$response, 400];
    }

    public function buildApiResponseForClientException($exception)
    {
        $response = [
            'error' => $exception->getMessage()
        ];

        return [$response, $exception->getResponse()->getStatusCode()];
    }
}