<?php

namespace App\Http\Traits;

use Illuminate\Http\Response;

trait RespondsWithHttpStatus
{
    protected function success(string $message, $data = [], int $status = 200): Response
    {
        return response([
            'success' => true,
            'data' => $data,
            'message' => $message,
        ], $status);
    }

    protected function failure(string $message, int $status = 422): Response
    {
        return response([
            'success' => false,
            'message' => $message,
        ], $status);
    }
}
