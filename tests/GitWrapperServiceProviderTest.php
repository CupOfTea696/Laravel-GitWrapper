<?php

namespace CupOfTea\Tests\GitWrapper;

use GitWrapper\GitWrapper;
use CupOfTea\GitWrapper\GitWrapperFactory;
use CupOfTea\GitWrapper\GitWrapperManager;
use GrahamCampbell\TestBenchCore\ServiceProviderTrait;

/**
 * @testdox CupOfTea\GitWrapper\GitWrapperServiceProvider
 */
class GitWrapperServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTrait;
    
    public function testGitWrapperFactoryIsInjectable()
    {
        $this->assertIsInjectable(GitWrapperFactory::class);
    }
    
    public function testGitWrapperManagerIsInjectable()
    {
        $this->assertIsInjectable(GitWrapperManager::class);
    }
    
    public function testBindings()
    {
        $this->assertIsInjectable(GitWrapper::class);
        
        $original = $this->app['git.connection'];
        $this->app['git']->reconnect();
        $new = $this->app['git.connection'];
        
        $this->assertNotSame($original, $new);
        $this->assertEquals($original, $new);
    }
}