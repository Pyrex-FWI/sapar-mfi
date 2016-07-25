<?php

namespace Sapar\Mfi\Filter;

use Sapar\Id3\Metadata\Id3Metadata;


/**
 * Class FilterCollection
 * @package Sapar\Mfi\Filter
 */
class ArtistFilter implements FilterInterface
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return bool
     */
    public function accept(Id3Metadata $metadata)
    {
        $result = false;
        if (strrpos(strtolower($this->name), strtolower($metadata->getArtist())) !== false) {
            $result = true;
        }

        return $result;
    }

    /**
     * @param FilterInterface $value
     * @return bool
     */
    public function add(FilterInterface $value)
    {
        return parent::add($value);
    }


}