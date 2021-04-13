<?php

namespace Japananimetime\Sberbank;

class Sberbank
{

    public const TYPE_PASSWORD = 'Password';
    public const TYPE_TOKEN = 'Token';
    public const TYPE_ERROR = 'No auth defined in env';

    public function getUsername()
    {
        return env('SBER_USERNAME');
    }

    public function getPassword()
    {
        return env('SBER_PASSWORD');
    }

    public function getToken()
    {
        return env('SBER_TOKEN');
    }

    public function getCurrentAuthorisationMethod()
    {
        if(env('SBER_TOKEN')) {
            return self::TYPE_TOKEN;
        }
        if(env('SBER_USERNAME') && env('SBER_PASSWORD')) {
            return self::TYPE_PASSWORD;
        }
        return self::TYPE_ERROR;
    }

    public function getAuthenticationData()
    {
        if($this->getCurrentAuthorisationMethod() == self::TYPE_TOKEN) {
            return $this->getToken();
        }
        if($this->getCurrentAuthorisationMethod() == self::TYPE_PASSWORD) {
            return [
                $this->getUsername(),
                $this->getPassword()
            ];
        }
    }

    public static function getMerchantLogin()
    {
        return env('SBER_MERCHANT_LOGIN');
    }

    public static function getPageView()
    {
        return config('SBER_PAGE_VIEW');
    }

    public static function getEndpoint()
    {
        return config('SBER_ENDPOINT');
    }

    public static function getCurrency()
    {
        return config('SBER_CURRENCY', 'KZT');
    }

    public static function getSessionTimeOutSeconds()
    {
        return config('SBER_SESSION_TIMEOUT_SECONDS');
    }

    public static function getReturnURL()
    {
        return config('SBER_RETURN_URL');
    }

    public static function getFailURL()
    {
        return config('SBER_FAIL_URL');
    }
}
