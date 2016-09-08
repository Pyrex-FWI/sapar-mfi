<?php

namespace Sapar\Mfi\Filter;

use Sapar\Id3\Metadata\Id3Metadata;


/**
 * Class FileNameFilter
 * @package Sapar\Mfi\Filter
 */
class FileNameFilter implements FilterInterface
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
        $source = $metadata->getFile()->getFilename();
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