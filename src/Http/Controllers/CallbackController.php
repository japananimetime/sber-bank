<?php

namespace Japananimetime\Sberbank\Http\Controllers;

use Japananimetime\Sberbank\Contracts\TransactionStatusContract;
use Japananimetime\Sberbank\Models\SberTransaction;
use Illuminate\Http\Request;

class CallbackController extends Controller
{
    public function success(Request $request)
    {
        SberTransaction
            ::where('orderID', $request->orderId)
            ->update(
                [
                    'status' => TransactionStatusContract::COMPLETED
                ]
            );
        return response([], 200);
    }

    public function failure(Request $request)
    {
        SberTransaction
            ::where('orderID', $request->orderId)
            ->update(
                [
                    'status' => TransactionStatusContract::DENIED
                ]
            );
        return response([], 200);
    }
}
