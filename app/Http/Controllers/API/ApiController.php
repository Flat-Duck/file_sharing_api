<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as BaseController;
class ApiController extends BaseController
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($message, $data, $profile = null, $code = 200)
    {
    	$response = [
            'success' => true,
            'message' => $message,        
            'data'    => $data,
            'profile' => $profile,
        
        ];
        return response()->json($response, $code);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}