<?php

namespace Sapar\MfiBundle;

use Sapar\Id3\Metadata\Id3Metadata;
use Sapar\Mfi;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class Finder
 * @package Sapar\MfiBundle
 */
class Finder extends Mfi\Finder
{
    /** @var  EventDispatcherInterface */
    private $eventDispatcher;

    /**
     * Finder constructor.
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        parent::__construct();
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param \SplFileInfo $file
     * @return \SplFileInfo
     */
    public function beforeFilterCollection(\SplFileInfo $file)
    {
        $event = new Event($file);
        $this->eventDispatcher->dispatch(Event::BEFORE_FILTER_COLLECTION, $event);
        return $event->getId3metadata()? : $event->getFile();
    }

}

/**
 * Class Event
 * @package Sapar\MfiBundle
 */
class Event extends \Symfony\Component\EventDispatcher\Event
{
    const BEFORE_FILTER_COLLECTION = 'mfi.finder.before.collection.filter';

    private $file;
    /** @var  Id3Metadata */
    private $id3metadata;

    /**
     * Event constructor.
     * @param \SplFileInfo $splFileInfo
     */
    public function __construct(\SplFileInfo $splFileInfo)
    {
        $this->file = $splFileInfo;
    }

    /**
     * @return \SplFileInfo
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param \SplFileInfo $splFileInfo
     * @return $this
     */
    public function setFile(\SplFileInfo $splFileInfo)
    {
        $this->file = $splFileInfo;

        return $this;
    }

    /**
     * @return Id3Metadata
     */
    public function getId3metadata()
    {
        return $this->id3metadata;
    }

    /**
     * @param $id3metadata
     * @return $this
     */
    public function setId3metadata($id3metadata)
    {
        $this->id3metadata = $id3metadata;

        return $this;
    }


}