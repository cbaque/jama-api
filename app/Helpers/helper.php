<?php

function response_data($data, $status, $message)
{
    return response()->json([
        'data'      => $data,
        'message'   => $message,
    ], $status);
}
