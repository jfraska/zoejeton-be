<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public const SUCCESS = 200;
    public const FORBIDDEN = 403;
    public const UNAUTHORIZED = 401;
    public const NOT_FOUND = 404;
    public const NOT_ALLOWED = 405;
    public const UNPROCESSABLE = 422;
    public const SERVER_ERROR = 500;
    public const BAD_REQUEST = 400;
    public const VALIDATION_ERROR = 252;


    public function sendResponse($result = [], $message = null)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, self::SUCCESS);
    }


    public function sendResponseWithMeta($result, $message)
    {
        $response = [
            'success' => true,
            'data'    => $result->items(),
            'meta' => [
                'total' => $result->total(),
                'current_page' => $result->currentPage(),
                'last_page' => $result->lastPage(),
                'next_page' => $result->nextPageUrl(),
                'prev_page' => $result->previousPageUrl(),
            ],
            'message' => $message,
        ];

        return response()->json($response, self::SUCCESS);
    }


    public function respondWithMessage($message = null)
    {
        return response()->json(['success' => true, 'message' => $message], self::SUCCESS);
    }


    public function sendError($code = null, $error = null, $errorMessages = [])
    {
        $response['success'] = false;

        switch ($code) {
            case self::UNAUTHORIZED:
                $response['message'] = 'Unauthorized';
                break;
            case self::FORBIDDEN:
                $response['message'] = 'Forbidden';
                break;
            case self::NOT_FOUND:
                $response['message'] = 'Not Found.';
                break;
            case self::NOT_ALLOWED:
                $response['message'] = 'Method Not Allowed.';
                break;
            case self::BAD_REQUEST:
                $response['message'] = 'Bad Request.';
                break;
            case self::UNPROCESSABLE:
                $response['message'] = 'Unprocessable Entity.';
                break;
            case self::SERVER_ERROR:
                $response['message'] = 'Whoops, looks like something went wrong.';
                break;
            case self::VALIDATION_ERROR:
                $response['message'] = 'Validation Error.';
                break;
            default:
                $response['message'] = 'Whoops, looks like something went wrong.';
                break;
        }

        $response['message'] = $error ? $error : $response['message'];
        if (!empty($errorMessages)) {
            $response['errors'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
