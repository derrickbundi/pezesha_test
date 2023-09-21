<?php
use Symfony\Component\HttpFoundation\Response;

function _httpOk($message,$data = null) {
    return response()->json(
        [
            'message' => $message,
            'data' => $data,
            'code' => Response::HTTP_OK
        ], Response::HTTP_OK
    );
}

function _httpCreated($message,$data = null) {
    return response()->json(
        [
            'message' => $message,
            'data' => $data,
            'code' => Response::HTTP_CREATED
        ], Response::HTTP_CREATED
    );
}

function _httpBadRequest($message,$errors = null) {
    return response()->json(
        [
            'message' => $message,
            'errors' => $errors,
            'code' => Response::HTTP_BAD_REQUEST
        ], Response::HTTP_BAD_REQUEST
    );
}