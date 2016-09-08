<?php

namespace Sapar\Mfi\Tests\Iterator;

use Symfony\Component\Finder\Tests\Iterator\IteratorTestCase;

abstract class RealIteratorTestCase extends IteratorTestCase
{
    protected static $tmpDir;
    protected static $files;

    public static function setUpBeforeClass()
    {
        self::$tmpDir = realpath(sys_get_temp_dir()).DIRECTORY_SEPARATOR.'symfony_finder';

        self::$files = array(
            '.git/',
            '.foo/',
            '.foo/.bar',
            '.foo/bar',
            '.bar',
            'test1.mp3',
            'foo/',
            'foo/bar3.flac',
            'test2.mp4',
            'toto/',
            'toto/.git/',
            'foo bar',
            'VA-Maad_some-name-2016/',
            'VA-Maad_some-name-2016/04-movado-jah_jah_be_praised.mp3',
            'VA-Maad_some-name-2015/',
            'VA-Maad_some-name-2015/04-movado-old.mp3',
            'movado-you-see-me.mp3',
            'AlbumDir-2016/',
            'AlbumDir-2016/admiral_t-Brile_macome.mp3',
        );

        self::$files = self::toAbsolute(self::$files);

        if (is_dir(self::$tmpDir)) {
            self::tearDownAfterClass();
        } else {
            mkdir(self::$tmpDir);
        }

        foreach (self::$files as $file) {
            if (DIRECTORY_SEPARATOR === $file[strlen($file) - 1]) {
                mkdir($file);
            } else {
                touch($file);
            }
        }

        file_put_contents(self::toAbsolute('test.mp4'), str_repeat(' ', 800));
        file_put_contents(self::toAbsolute('test.mp3'), str_repeat(' ', 2000));

    }

    public static function tearDownAfterClass()
    {
        foreach (array_reverse(self::$files) as $file) {
            if (DIRECTORY_SEPARATOR === $file[strlen($file) - 1]) {
                @rmdir($file);
            } else {
                @unlink($file);
            }
        }
    }

    protected static function toAbsolute($files = null)
    {
        /*
         * Without the call to setUpBeforeClass() property can be null.
         */
        if (!self::$tmpDir) {
            self::$tmpDir = realpath(sys_get_temp_dir()).DIRECTORY_SEPARATOR.'symfony_finder';
        }

        if (is_array($files)) {
            $f = array();
            foreach ($files as $file) {
                if (is_array($file)) {
                    $f[] = self::toAbsolute($file);
                } else {
                    $f[] = self::$tmpDir.DIRECTORY_SEPARATOR.str_replace('/', DIRECTORY_SEPARATOR, $file);
                }
            }

            return $f;
        }

        if (is_string($files)) {
            return self::$tmpDir.DIRECTORY_SEPARATOR.str_replace('/', DIRECTORY_SEPARATOR, $files);
        }

        return self::$tmpDir;
    }

    protected static function toAbsoluteFixtures($files)
    {
        $f = array();
        foreach ($files as $file) {
            $f[] = realpath(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Fixtures'.DIRECTORY_SEPARATOR.$file);
        }

        return $f;
    }
}
