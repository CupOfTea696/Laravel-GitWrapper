<?php

namespace CupOfTea\Tests\GitWrapper;

use Mockery;
use GitWrapper\GitWrapper;
use Psr\Log\LoggerInterface;
use InvalidArgumentException;
use Illuminate\Log\LogManager;
use Illuminate\Container\Container;
use CupOfTea\GitWrapper\GitWrapperFactory;
use GrahamCampbell\TestBench\AbstractTestCase as AbstractTestBenchTestCase;

class GitWrapperFactoryTest extends AbstractTestBenchTestCase
{
    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testMakeStandard()
    {
        $factory = $this->getFactory();
        
        $gitWrapper = Mockery::mock('overload:' . GitWrapper::class);
        $gitWrapper->shouldReceive('__construct')->once()->with(Mockery::type('string'));
        
        $git = $factory[0]->make(['auth' => 'none']);
        
        $this->assertInstanceOf(GitWrapper::class, $git);
    }
    
    public function testMakeStandardExplicitLogger()
    {
        $factory = $this->getFactory();
        
        $factory[1]->shouldReceive('channel')->once()->with(null)->andReturn(Mockery::mock(LoggerInterface::class));
        
        $git = $factory[0]->make(['auth' => 'none', 'logger' => true]);
        
        $this->assertInstanceOf(GitWrapper::class, $git);
    }
    
    public function testMakeStandardNamedLogger()
    {
        $factory = $this->getFactory();
        
        $factory[1]->shouldReceive('channel')->once()->with('slack')->andReturn(Mockery::mock(LoggerInterface::class));
        
        $git = $factory[0]->make(['auth' => 'none', 'logger' => 'slack']);
        
        $this->assertInstanceOf(GitWrapper::class, $git);
    }
    
    public function testMakeStandardStackLogger()
    {
        $factory = $this->getFactory();
        
        $factory[1]->shouldReceive('stack')->once()->with(['single', 'slack'])->andReturn(Mockery::mock(LoggerInterface::class));
        
        $git = $factory[0]->make(['auth' => 'none', 'logger' => ['single', 'slack']]);
        
        $this->assertInstanceOf(GitWrapper::class, $git);
    }
    
    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testMakeAuth()
    {
        $factory = $this->getFactory();
        
        $gitWrapper = Mockery::mock('overload:' . GitWrapper::class);
        $gitWrapper->shouldReceive('setPrivateKey')->once()->with('path', 22);
        
        $git = $factory[0]->make(['auth' => 'ssh_key', 'key_path' => 'path']);
    }
    
    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testMakeAuthWithPort()
    {
        $factory = $this->getFactory();
        
        $gitWrapper = Mockery::mock('overload:' . GitWrapper::class);
        $gitWrapper->shouldReceive('setPrivateKey')->once()->with('path', 2222);
        
        $git = $factory[0]->make(['auth' => 'ssh_key', 'key_path' => 'path', 'port' => 2222]);
    }
    
    public function testMakeAuthWithoutKeyPath()
    {
        $factory = $this->getFactory();
        
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The gitwrapper factory requires a key path for the auth method "ssh_key".');
        
        $git = $factory[0]->make(['auth' => 'ssh_key']);
    }
    
    public function testMakeEmpty()
    {
        $factory = $this->getFactory();
        
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The gitwrapper factory requires an auth method.');
        
        $factory[0]->make([]);
    }
    
    protected function getFactory()
    {
        $log = Mockery::mock(LogManager::class);
        $container = new Container;
        
        $container->instance('log', $log);
        
        return [new GitWrapperFactory($container), $log];
    }
}
