<?php

namespace Sapar\Mfi;

use Sapar\Id3\Metadata\Id3Metadata;
use Sapar\Mfi\Filter\FilterCollection;
use Sapar\Mfi\Filter\FilterInterface;

/**
 * Class Finder
 * @package Sapar\Mfi\Finder
 */
class Finder extends \Symfony\Component\Finder\Finder
{
    private static $mediaPatterns = array('/.mp3$/', '/.mp4$/', '/.flac$/');
    /** @var  FilterCollection */
    private $filterCollecterion;

    /**
     * Finder constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->files();
        foreach (self::$mediaPatterns as $mediaPattern) {
            $this->name($mediaPattern);
        }

        $this->ignoreUnreadableDirs(true);

        $this->filterCollecterion = new FilterCollection();
    }

    /**
     * @param FilterInterface $mediaFilter
     * @return $this
     */
    public function addMediaFilter(FilterInterface $mediaFilter)
    {
        $this->filterCollecterion->add($mediaFilter);

        return $this;
    }

    /**
     * @return \Iterator|\Symfony\Component\Finder\SplFileInfo[]
     */
    public function getIterator()
    {
        $this->filter(function (\SplFileInfo $file) {
            $data = $this->beforeFilterCollection($file);

            return $this->filterCollecterion->accept($data);
        });

        return parent::getIterator();
    }

    /**
     * @param \SplFileInfo $file
     * @return \SplFileInfo
     */
    public function beforeFilterCollection(\SplFileInfo $file)
    {
        return new Id3Metadata($file->getPathname());
    }


}