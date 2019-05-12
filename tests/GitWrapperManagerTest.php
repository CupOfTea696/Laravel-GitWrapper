<?php

namespace CupOfTea\Tests\GitWrapper;

use Mockery;
use GitWrapper\GitWrapper;
use CupOfTea\GitWrapper\GitWrapperFactory;
use CupOfTea\GitWrapper\GitWrapperManager;
use Illuminate\Contracts\Config\Repository;
use GrahamCampbell\TestBench\AbstractTestCase as AbstractTestBenchTestCase;

class GitWrapperManagerTest extends AbstractTestBenchTestCase
{
    public function testCreateConnection()
    {
        $config = ['auth' => 'none'];

        $manager = $this->getManager($config);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('git.default')->andReturn('main');

        $this->assertSame([], $manager->getConnections());

        $return = $manager->connection();

        $this->assertInstanceOf(GitWrapper::class, $return);

        $this->assertArrayHasKey('main', $manager->getConnections());
    }

    protected function getManager(array $config)
    {
        $repo = Mockery::mock(Repository::class);
        $factory = Mockery::mock(GitWrapperFactory::class);

        $manager = new GitWrapperManager($repo, $factory);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('git.connections')->andReturn(['main' => $config]);

        $config['name'] = 'main';

        $manager->getFactory()->shouldReceive('make')->once()
            ->with($config)->andReturn(new GitWrapper);

        return $manager;
    }
}
