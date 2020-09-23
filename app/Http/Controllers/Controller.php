<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    // use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function ok($message, $data = null)
    {
        return response()->json([
            'meta' => [
                'code'    => 200,
                'status'  => 'success',
                'message' => $message
            ],
            'results' => $data
        ], 200);
    }

    protected function created($message,  $data)
    {
        return response()->json([
            'meta' => [
                'code'    => 201,
                'status'  => 'created',
                'message' => $message
            ],
            'results' => $data
        ], 201);
    }

    protected function notFound($message, $data = null)
    {
        return response()->json([
            'meta' => [
                'code' => 404,
                'status' => 'not found',
                'message' => $message
            ],
            'results' => $data
        ], 404);
    }

    protected function badRequest($message, $data = null)
    {
        return response()->json([
            'meta' => [
                'code' => 500,
                'status' => 'Bad request',
                'message' => $message
            ],
            'results' => $data
        ], 500);
    }

    protected function unauthorized($message = 'Access Denied')
    {
        return response()->json([
            'meta' => [
                'code' => 401,
                'status' => 'access denied',
                'message' => $message
            ],
            'results' => null
        ], 401);
    }

    public function internalServerError($message, $data = null)
    {
        return response()->json([
            'meta' => [
                'code' => 500,
                'status' => 'server error',
                'message' => $message
            ],
            'results' => $data
        ]);
    }
}
