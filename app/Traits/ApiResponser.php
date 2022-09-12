<?php

namespace App\Traits;

use Illuminate\Http\Resources\Json\ResourceCollection;


trait ApiResponser
{
    /**
     * Return a success JSON response.
     *
     * @param  array|string  $data
     * @param  string  $message
     * @param  int|null  $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function success($data =null , string $message = null, int $code = 200)
    {
        return response()->json([
            'status' => 'SUCCESS',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * Return a success JSON response.
     *
     * @param  ResourceCollection  $collection
     * @param  string  $message
     * @param  int|null  $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function successWithResourceCollection(ResourceCollection $collection , string $message = null, int $code = 200)
    {
        return response()->json([
            'status' => 'SUCCESS',
            'message' => $message,
            'data' => $collection->toResponse()
        ], $code);
    }

    /**
     * Return an error JSON response.
     *
     * @param  string  $message
     * @param  int  $code
     * @param  array|string|null  $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function error(string $message = null, int $code = 200, $data = null)
    {
        return response()->json([
            'status' => 'ERROR',
            'message' => $message,
            'data' => $data
        ], $code);
    }

}
