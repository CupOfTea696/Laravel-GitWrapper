<?php

namespace CupOfTea\Tests\GitWrapper\Facades;

use CupOfTea\GitWrapper\Facades\Git;
use CupOfTea\GitWrapper\GitWrapperManager;
use GrahamCampbell\TestBenchCore\FacadeTrait;
use CupOfTea\Tests\GitWrapper\AbstractTestCase;

/**
 * @testdox CupOfTea\GitWrapper\Facades\Git
 */
class GitTest extends AbstractTestCase
{
    use FacadeTrait;

    /**
     * Get the facade accessor.
     *
     * @return string
     */
    protected function getFacadeAccessor()
    {
        return 'git';
    }

    /**
     * Get the facade class.
     *
     * @return string
     */
    protected function getFacadeClass()
    {
        return Git::class;
    }

    /**
     * Get the facade root.
     *
     * @return string
     */
    protected function getFacadeRoot()
    {
        return GitWrapperManager::class;
    }
}
