<?php

namespace App\Traits;

trait ApiResponseTrait
{
    /**
     * Return a successful response
     *
     * @param mixed $data
     * @param string $message
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    protected function successResponse($data, $message = 'Success', $status = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    /**
     * Return an error response
     *
     * @param string $message
     * @param int $status
     * @param mixed $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function errorResponse($message = 'Error', $status = 400, $data = null)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    /**
     * Return a validation error response
     *
     * @param string|array $errors
     * @param string $message
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    protected function validationErrorResponse($errors, $message = 'Validation Error', $status = 422)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'errors' => $errors,
        ], $status);
    }
}
