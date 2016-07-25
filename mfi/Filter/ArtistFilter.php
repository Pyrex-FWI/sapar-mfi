<?php

namespace Sapar\Mfi\Filter;

use PhpId3\Id3TagsReader;
use Symfony\Component\Finder\SplFileInfo;

/**
 * Class GenreFilterIterator
 * @package Sapar\Mfi\Iterator
 */
class ArtistFilter implements FilterInterface
{
    private $name;

    public function __construct($name)
    {
        $this->name = strtolower($name);
    }
    /**
     * Check whether the current element of the iterator is acceptable
     * @link http://php.net/manual/en/filteriterator.accept.php
     * @return bool true if the current element is acceptable, otherwise false.
     * @since 5.1.0
     */
    public function accept(SplFileInfo $file)
    {
        if($file->getExtension() !== 'mp3') return;

        try {

            $getID3 = new \getID3();
            $data = $getID3->analyze($file->getPathname());
            if (isset($data['tags']['id3v2']['artist'][0])) {
                $data = $data['tags']['id3v2']['artist'][0];
                return strrpos(strtolower($data), $this->name) !== false ? true : false;
            }
        } catch (\Exception $e) {

        }
        return false;
    }
}