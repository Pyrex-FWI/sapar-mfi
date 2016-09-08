<?php

namespace Sapar\Mfi\Filter;

use Sapar\Id3\Metadata\Id3Metadata;


/**
 * Class PathNameFilter
 * @package Sapar\Mfi\Filter
 */
class PathNameFilter implements FilterInterface
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
        $source = $metadata->getFile()->getPath();
        if (strrpos(strtolower($source), strtolower($this->name)) !== false) {
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