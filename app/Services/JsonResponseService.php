<?php
namespace App\Services;

class JsonResponseService
{
    public static function json(string $message, bool $success = true, int $status = 200, array | null $data = [])
    {
        return response()->json([
            'message' => $message,
            'success' => $success,
            'status' => $status,
            'data' => $data
        ], $status);
    }
}

?>
