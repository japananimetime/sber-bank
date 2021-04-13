<?php


namespace Japananimetime\Sberbank\Services;


use Illuminate\Support\Facades\Http;
use Japananimetime\Sberbank\Contracts\TransactionStatusContract;
use Japananimetime\Sberbank\Models\SberTransaction;
use Japananimetime\Sberbank\Sberbank;

class TransactionService
{
    /*
     *
     * @param array $order
     *      $order = [
     *          'id' => string|integer,
     *          'description' => string
     *      ]
     * @param integer $amount
     * @param User $user
     * @param array $jsonParams
     *
     */
    public function register($order, $amount, $user, $jsonParams, $expirationDate = null)
    {

        $data = [
            'orderNumber'        => $order->id,
            'amount'             => $amount * 100, // Tenge consists of 100 tiyns
            'currency'           => Sberbank::getCurrency(),
            'returnUrl'          => Sberbank::getReturnURL(),
            'failUrl'            => Sberbank::getFailURL(),
            'pageView'           => Sberbank::getPageView(),
            'description'        => $order->description,
            'clientId'           => $user->clientId, //TODO Add to user migration
            'merchantLogin'      => Sberbank::getMerchantLogin(),
            'jsonParams'         => $jsonParams,
            'sessionTimeoutSecs' => Sberbank::getSessionTimeOutSeconds(),
            'expirationDate'     => $expirationDate,
            'bindingId'          => $user->bindingId, //TODO Add to user migration
            //'features'           => $this->features,
            'email'              => $user->email,
            'phone'              => $user->phone, //TODO Add to user migration
        ];

        $data = array_merge($data, $this->getAuthenticationData());

        $response = Http
            ::dd()
            ->asForm()
            ->post(config('SBER_ENDPOINT') . 'register.do', $data)
        ;

        $responseData = $response->json();

        SberTransaction
            ::create(
                [
                    'sber_id'     => $responseData['orderId'],
                    'orderNumber' => $order->id,
                    'amount'      => $amount,
                    'user_id'     => $user->id,
                    'jsonParams'  => $jsonParams,
                    'status'      => TransactionStatusContract::NEW,
                ]
            );

        return response(
            [
                'url' => $responseData['formUrl'],
            ], 200
        );
    }

    public function reverse()
    {
        $data = [
            'orderId'    => $this->orderID,
            'jsonParams' => $this->jsonParams,
        ];

        return Http
            ::dd()
            ->asForm()
            ->post($this->getEndpoint() . 'reverse.do', $data)
            ;
    }

    public function refund()
    {
        $data = [
            'orderId'    => $this->orderID,
            'amount'     => $this->amount,
            'jsonParams' => $this->jsonParams,
        ];

        return Http::dd()
                   ->asForm()
                   ->post($this->getEndpoint() . 'refund.do', $data)
            ;
    }

    public function status()
    {
        $data = [
            'orderId'     => $this->orderID,
            'orderNumber' => $this->orderNumber,
        ];

        return Http::dd()
                   ->asForm()
                   ->post($this->getEndpoint() . 'getOrderStatusExtended.do', $data)
            ;
    }
}

