<?php

namespace Sapar\Mfi\Tests;


use Sapar\Mfi\Filter\FileNameFilter;
use Sapar\Mfi\Filter\PathNameFilter;
use Sapar\Mfi\Finder;
use Sapar\Mfi\Tests\Iterator\RealIteratorTestCase;

/**
 * Class FinderTest
 * @package Sapar\Mfi\Tests
 */
class FinderTest extends RealIteratorTestCase
{

    public function testCreate()
    {
        $this->assertInstanceOf('Sapar\Mfi\Finder', Finder::create());
    }

    public function testFiles()
    {
        $finder = $this->buildFinder();
        $this->assertSame($finder, $finder->files());
        $this->assertIterator(
            $this->toAbsolute([
                'AlbumDir-2016/admiral_t-Brile_macome.mp3',
                'VA-Maad_some-name-2015/04-movado-old.mp3',
                'VA-Maad_some-name-2016/04-movado-jah_jah_be_praised.mp3',
                'foo/bar3.flac',
                'movado-you-see-me.mp3',
                'test.mp3',
                'test.mp4',
                'test1.mp3',
                'test2.mp4',
            ]),
            $finder->in(self::$tmpDir)->getIterator()
        );

        $finder = $this->buildFinder();
        $finder->files();
        $finder->directories();
        $finder->files();
        $this->assertIterator(
            $this->toAbsolute([
                'AlbumDir-2016/admiral_t-Brile_macome.mp3',
                'VA-Maad_some-name-2015/04-movado-old.mp3',
                'VA-Maad_some-name-2016/04-movado-jah_jah_be_praised.mp3',
                'foo/bar3.flac',
                'movado-you-see-me.mp3',
                'test.mp3',
                'test.mp4',
                'test1.mp3',
                'test2.mp4',

            ]),
            $finder->in(self::$tmpDir)->getIterator()
        );


        $iterator = $this->buildFinder()
            ->addMediaFilter(new FileNameFilter('movado'))
            ->addMediaFilter(new PathNameFilter('2016'))
            ->in([self::$tmpDir])->files()->getIterator();

        $this->assertIterator(
            $this->toAbsolute([
                'VA-Maad_some-name-2016/04-movado-jah_jah_be_praised.mp3',
            ]),
            $iterator
        );

    }

    /**
     * @return \Sapar\Mfi\Finder
     */
    protected function buildFinder()
    {
        return Finder::create();
    }
}
