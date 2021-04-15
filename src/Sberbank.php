<?php

namespace Japananimetime\Sberbank;

class Sberbank
{

    public const TYPE_PASSWORD = 'Password';
    public const TYPE_TOKEN = 'Token';
    public const TYPE_ERROR = 'No auth defined in env';

    public static function getUsername()
    {
        return env('SBER_USERNAME');
    }

    public static function getPassword()
    {
        return env('SBER_PASSWORD');
    }

    public static function getToken()
    {
        return env('SBER_TOKEN');
    }

    public static function getCurrentAuthorisationMethod()
    {
        if(env('SBER_TOKEN')) {
            return self::TYPE_TOKEN;
        }
        if(env('SBER_USERNAME') && env('SBER_PASSWORD')) {
            return self::TYPE_PASSWORD;
        }
        return self::TYPE_ERROR;
    }

    public static function getAuthenticationData()
    {
        if(self::getCurrentAuthorisationMethod() == self::TYPE_TOKEN) {
            return [
                'token' => self::getToken()
            ];
        }
        if(self::getCurrentAuthorisationMethod() == self::TYPE_PASSWORD) {
            return [
                'userName' => self::getUsername(),
                'password' => self::getPassword()
            ];
        }
    }

    public static function getMerchantLogin()
    {
        return env('SBER_MERCHANT_LOGIN');
    }

    public static function getPageView()
    {
        return config('sberbank.SBER_PAGE_VIEW');
    }

    public static function getEndpoint()
    {
        return config('sberbank.SBER_ENDPOINT');
    }

    public static function getCurrency()
    {
        return config('sberbank.SBER_CURRENCY', 'KZT');
    }

    public static function getSessionTimeOutSeconds()
    {
        return config('sberbank.SBER_SESSION_TIMEOUT_SECONDS');
    }

    public static function getReturnURL(): string
    {
        return env('APP_URL') . config('sberbank.SBER_RETURN_URL');
    }

    public static function getFailURL(): string
    {
        return env('APP_URL') . config('sberbank.SBER_FAIL_URL');
    }
}
