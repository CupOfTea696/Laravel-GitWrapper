<?php

namespace CupOfTea\Tests\GitWrapper;

use Laravel\Lumen\Application;
use PHPUnit\Framework\TestCase;
use GrahamCampbell\Analyzer\AnalysisTrait;

class AnalysisTest extends TestCase
{
    use AnalysisTrait;
    
    /**
     * Get the code paths to analyze.
     *
     * @return string[]
     */
    protected function getPaths()
    {
        return [
            realpath(__DIR__ . '/../config'),
            realpath(__DIR__ . '/../src'),
            realpath(__DIR__),
        ];
    }
    
    /**
     * Get the classes to ignore not existing.
     *
     * @return string[]
     */
    protected function getIgnored()
    {
        return [Application::class];
    }
}
