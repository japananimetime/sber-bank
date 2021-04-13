<?php

namespace Japananimetime\Sberbank\Tests;

use Orchestra\Testbench\TestCase;
use Japananimetime\Sberbank\SberbankServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [SberbankServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
