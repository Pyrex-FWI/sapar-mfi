<?php

namespace Sapar\Mfi\Filter;

use Symfony\Component\Finder\SplFileInfo;

/**
 * Class FilterInterface
 * @package Sapar\Mfi\Filter
 */
interface FilterInterface
{
    /**
     * @return bool
     */
    public function accept(SplFileInfo $file);
}