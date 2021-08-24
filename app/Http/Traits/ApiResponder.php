<?php

namespace App\Http\Traits;

use Illuminate\Http\Response;

trait ApiResponder {

    /**
     * Success response
     *
     * @param any|null $data
     * @param string $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function successResponse ( $data = null, $message = 'Ok', $code = Response::HTTP_OK )
    {
        $response = [
            'status' => 'success'
        ];
        isset($message) ? $response['message'] = $message : null;
        isset($data   ) ? $response['data'   ] = $data    : null;

        return response()->json($response, $code);
    }

    /**
     * Fail response
     *
     * @param any|null $data
     * @param string $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function failResponse($data = null, $message = 'Bad request.', $code = Response::HTTP_BAD_REQUEST)
    {
        $response = [
            'status' => 'fail'
        ];
        isset($message) ? $response['message'] = $message : null;
        isset($data   ) ? $response['data'   ] = $data    : null;

        return response()->json($response, $code);
    }

    /**
     * Error response
     *
     * @param any|null $data
     * @param string $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function errorResponse ( $data = null, $message = 'Internal server error.', $code = Response::HTTP_INTERNAL_SERVER_ERROR )
    {
        $response = [
            'status' => 'error',
        ];
        isset($message) ? $response['message'] = $message : null;
        isset($data   ) ? $response['data'   ] = $data    : null;

        return response()->json($response, $code);
    }

    /**
     * Not found response
     *
     * @param any|null $data
     * @param string $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function notFoundResponse ( $data = null, $message = 'Resource not found.', $code = Response::HTTP_NOT_FOUND )
    {
        $response = [
            'status' => 'error',
        ];
        isset($message) ? $response['message'] = $message : null;
        isset($data   ) ? $response['data'   ] = $data    : null;

        return response()->json($response, $code);
    }

}
