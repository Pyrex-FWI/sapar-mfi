<?php

namespace Sapar\Mfi;

use Sapar\Mfi\Filter\ArtistFilter;

/**
 * Class Finder
 * @package Sapar\Mfi\Finder
 */
class Finder extends \Symfony\Component\Finder\Finder
{
    private static $mediaPatterns = array('/.mp3$/', '/.mp4$/', '/.flac$/');

    public function __construct()
    {
        parent::__construct();
        $this->files();

        foreach (self::$mediaPatterns as $mediaPattern) {
            $this->name($mediaPattern);
        }

        $this->ignoreUnreadableDirs(true);
    }

    /**
     * @param $name
     * @return $this
     */
    public function filterByArtistName($name)
    {
        $artistFilter = new ArtistFilter($name);
        $filter = function (\SplFileInfo $file) use ($artistFilter)
        {
            gc_enable();
            $result = $artistFilter->accept($file);
            gc_collect_cycles();
            return $result;
        };

        $this->filter($filter);

        return $this;
    }

}