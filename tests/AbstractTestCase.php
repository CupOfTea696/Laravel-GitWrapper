<?php

namespace CupOfTea\Tests\GitWrapper;

use CupOfTea\GitWrapper\GitWrapperServiceProvider;
use GrahamCampbell\TestBench\AbstractPackageTestCase;

class AbstractTestCase extends AbstractPackageTestCase
{
    /**
     * Get the service provider class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return string
     */
    protected function getServiceProviderClass($app)
    {
        return GitWrapperServiceProvider::class;
    }
}
