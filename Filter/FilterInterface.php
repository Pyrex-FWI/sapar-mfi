<?php

namespace Sapar\Mfi\Filter;

use Sapar\Id3\Metadata\Id3Metadata;


/**
 * Class FilterInterface
 * @package Sapar\Mfi\Filter
 */
interface FilterInterface
{
    /**
     * @return bool
     */
    public function accept(Id3Metadata $id3Metadata);
}