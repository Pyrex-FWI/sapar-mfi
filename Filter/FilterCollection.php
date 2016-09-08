<?php

namespace Sapar\Mfi\Filter;

use Doctrine\Common\Collections\ArrayCollection;
use Sapar\Id3\Metadata\Id3Metadata;

/**
 * Class FilterCollection
 * @package Sapar\Mfi\Filter
 */
class FilterCollection implements FilterInterface
{

    /** ArrayCollection */
    private $filters;

    public function __construct()
    {
        $this->filters = new ArrayCollection();
    }

    /**
     * @param Id3Metadata $id3Metadata
     * @return bool|null
     */
    public function accept(Id3Metadata $id3Metadata)
    {
        /** @var FilterInterface[] $filters */
        $filters = $this->filters->getValues();
        $result = $filters ? null : true;
        foreach ($filters as $filter) {
            $result = $filter->accept($id3Metadata);
            if (!is_bool($result)) {
                $result = null;
                continue;
            }
            if ($result === false) {
                break;
            }
        }

        return $result;
    }

    /**
     * @param FilterInterface $value
     * @return bool
     */
    public function add(FilterInterface $value)
    {
        return $this->filters->add($value);
    }
}