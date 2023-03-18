<?php

if (! function_exists('sendResponse')) {

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];
        return response() -> json($response, 200);
    }
}
