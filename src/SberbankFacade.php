<?php

namespace Japananimetime\Sberbank;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Japananimetime\Sberbank\Skeleton\SkeletonClass
 */
class SberbankFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'sberbank';
    }
}
