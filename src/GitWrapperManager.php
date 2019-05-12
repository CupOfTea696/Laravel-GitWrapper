<?php

namespace CupOfTea\GitWrapper;

use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;

/**
 * @mixin \GitWrapper\GitWrapper
 */
class GitWrapperManager extends AbstractManager
{
    /**
     * The factory instance.
     *
     * @var \CupOfTea\GitWrapper\GitWrapperFactory
     */
    protected $factory;

    /**
     * Create a new github manager instance.
     *
     * @param  \Illuminate\Contracts\Config\Repository  $config
     * @param  \CupOfTea\GitWrapper\GitWrapperFactory  $factory
     *
     * @return void
     */
    public function __construct(Repository $config, GitWrapperFactory $factory)
    {
        parent::__construct($config);

        $this->factory = $factory;
    }

    /**
     * Get the factory instance.
     *
     * @return \CupOfTea\GitWrapper\GitWrapperFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }

    /**
     * Create the connection instance.
     *
     * @param  array  $config
     *
     * @return \GitWrapper\GitWrapper
     */
    protected function createConnection(array $config)
    {
        return $this->factory->make($config);
    }

    /**
     * Get the configuration name.
     *
     * @return string
     */
    protected function getConfigName()
    {
        return 'git';
    }
}
