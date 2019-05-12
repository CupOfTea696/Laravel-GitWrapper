<?php

namespace CupOfTea\GitWrapper;

use GitWrapper\GitWrapper;
use Illuminate\Support\Arr;
use InvalidArgumentException;
use Illuminate\Contracts\Container\Container;
use GitWrapper\Event\GitLoggerEventSubscriber;
use Symfony\Component\Process\ExecutableFinder;

class GitWrapperFactory
{
    /**
     * The Application Container.
     *
     * @var \Illuminate\Contracts\Container\Container
     */
    protected $app;

    /**
     * Create a new GitWrapperFactory instance.
     *
     * @param  \Illuminate\Contracts\Container\Container  $app
     *
     * @return void
     */
    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    /**
     * Make a new gitwrapper instance.
     *
     * @param  string[]  $config
     *
     * @return \GitWrapper\GitWrapper
     * @throws \InvalidArgumentException
     *
     */
    public function make(array $config)
    {
        $git = new GitWrapper($this->getExecutable());

        if (! Arr::has($config, 'auth')) {
            throw new InvalidArgumentException('The gitwrapper factory requires an auth method.');
        }

        if (value(Arr::get($config, 'auth')) === 'ssh_key') {
            if (! Arr::has($config, 'key_path')) {
                throw new InvalidArgumentException('The gitwrapper factory requires a key path for the auth method "ssh_key".');
            }

            $this->addSshKey($git, $config);
        }

        if ($channel = value(Arr::get($config, 'logger'))) {
            if (is_string($channel) || is_array($channel)) {
                $this->addLogger($git, $channel);
            } else {
                $this->addLogger($git);
            }
        }

        return $git;
    }

    /**
     * Get the git executable.
     *
     * @return string
     */
    protected function getExecutable()
    {
        return with(new ExecutableFinder)->find('git', 'git');
    }

    /**
     * Add an ssh key to the GitWrapper instance.
     *
     * @param  \GitWrapper\GitWrapper  $git
     * @param  array  $config
     *
     * @return void
     */
    protected function addSshKey(GitWrapper $git, array $config)
    {
        $git->setPrivateKey(value(Arr::get($config, 'key_path')), value(Arr::get($config, 'port', 22)));
    }

    /**
     * Add a logger to the GitWrapper instance.
     *
     * @param  \GitWrapper\GitWrapper  $git
     * @param  mixed  $channel
     *
     * @return void
     */
    protected function addLogger(GitWrapper $git, $channel = null)
    {
        $log = $this->app['log'];

        if (is_array($channel)) {
            $log = $log->stack($channel);
        } else {
            $log = $log->channel($channel);
        }

        $git->addLoggerEventSubscriber(new GitLoggerEventSubscriber($log));
    }
}
