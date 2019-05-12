<?php

namespace CupOfTea\GitWrapper\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Git
 *
 * @method static \Symfony\Component\EventDispatcher\EventDispatcherInterface getDispatcher()
 * @method static void setDispatcher(\Symfony\Component\EventDispatcher\EventDispatcherInterface $eventDispatcher)
 * @method static void setGitBinary($gitBinary)
 * @method static string getGitBinary()
 * @method static void setEnvVar($var, $value)
 * @method static void unsetEnvVar($var)
 * @method static mixed getEnvVar($var, $default = null)
 * @method static array getEnvVars()
 * @method static void setTimeout($timeout)
 * @method static int getTimeout()
 * @method static void setPrivateKey($privateKey, $port = 22, $wrapper = null)
 * @method static void unsetPrivateKey()
 * @method static void addOutputListener(\GitWrapper\Event\GitOutputListenerInterface $gitOutputListener)
 * @method static void addLoggerEventSubscriber(\GitWrapper\Event\GitLoggerEventSubscriber $gitLoggerEventSubscriber)
 * @method static void removeOutputListener(\GitWrapper\Event\GitOutputListenerInterface $gitOutputListener)
 * @method static void streamOutput($streamOutput = true)
 * @method static \GitWrapper\GitWorkingCopy workingCopy($directory)
 * @method static string version()
 * @method static string parseRepositoryName($repositoryUrl)
 * @method static \GitWrapper\GitWorkingCopy init($directory, $options = [])
 * @method static \GitWrapper\GitWorkingCopy cloneRepository($repository, $directory = null, $options = [])
 * @method static string git($commandLine, $cwd = null)
 * @method static string run(\GitWrapper\GitCommand $gitCommand, $cwd = null)
 * @see \GitWrapper\GitWrapper
 * @method static \CupOfTea\GitWrapper\GitWrapperFactory[] test()
 * @method static \CupOfTea\GitWrapper\GitWrapperFactory getFactory()
 * @method static object connection($name = null)
 * @method static object reconnect($name = null)
 * @method static void disconnect($name = null)
 * @method static array getConnectionConfig($name = null)
 * @method static string getDefaultConnection()
 * @method static void setDefaultConnection($name)
 * @method static void extend($name, $resolver)
 * @method static object[] getConnections()
 * @method static \Illuminate\Contracts\Config\Repository getConfig()
 * @see \CupOfTea\GitWrapper\GitWrapperManager
 */
class Git extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'git';
    }
}
