<?php

namespace Japananimetime\Sberbank\Contracts;

interface TransactionStatusContract
{
    public const NEW            = 0; //- Заказ зарегистрирован, но не оплачен;
    public const PREDAUTHORIZED = 1; //- Предавторизованная сумма захолдирована (для двухстадийных платежей);
    public const COMPLETED      = 2; //- Проведена полная авторизация суммы заказа;
    public const CANCELLED      = 3; //- Авторизация отменена;
    public const REVERSED       = 4; //- По транзакции была проведена операция возврата;
    public const AUTHORIZING    = 5; //- Инициирована авторизация через ACS банка-эмитента;
    public const DENIED         = 6; //- Авторизация отклонена.
}
