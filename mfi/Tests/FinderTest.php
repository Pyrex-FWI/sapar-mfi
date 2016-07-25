<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sapar\Mfi\Tests;


use Sapar\Mfi\Finder;
use Sapar\Mfi\Tests\Iterator\RealIteratorTestCase;

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
        $this->assertIterator($this->toAbsolute(array('foo/bar3.flac', 'test.mp3', 'test.mp4', 'test1.mp3', 'test2.mp4')), $finder->in(self::$tmpDir)->getIterator());

        $finder = $this->buildFinder();
        $finder->files();
        $finder->directories();
        $finder->files();
        $this->assertIterator($this->toAbsolute(array('foo/bar3.flac', 'test.mp3', 'test.mp4', 'test1.mp3', 'test2.mp4')), $finder->in(self::$tmpDir)->getIterator());

        $it = $this->buildFinder()->in(["/Volumes/Extend/"])->filterByArtistName('Sizzla')->files()->getIterator();
        foreach ($it as $file) {
            dump($file."");
        }

    }

    /**
     * @return \Sapar\Mfi\Finder
     */
    protected function buildFinder()
    {
        return Finder::create();
    }
}
