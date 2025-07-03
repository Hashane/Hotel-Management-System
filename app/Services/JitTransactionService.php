<?php

namespace App\Services;

use DB;
use Log;
use Throwable;

class JitTransactionService
{
    public function run(callable $callback): array
    {
        try {
            $result = DB::transaction($callback);

            return [
                'success' => true,
                'data' => $result,
                'message' => 'Completed successfully.',
            ];

        } catch (Throwable $e) {
            Log::error('Transaction failed: '.$e->getMessage());

            return [
                'success' => false,
                'data' => null,
                'message' => 'Something went wrong.',
                'error' => $e->getMessage(),
            ];
        }
    }
}
