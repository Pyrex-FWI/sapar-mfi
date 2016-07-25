<?php
/**
 * Created by PhpStorm.
 * User: yemistikris
 * Date: 30/07/16
 * Time: 03:27
 */

namespace Sapar\MfiBundle\Listener;


use Sapar\Id3\Metadata\Id3Metadata;
use Sapar\Id3Bundle\Id3Manager;
use Sapar\MfiBundle\Event;

class MfiListener
{
    private $id3Manager;

    public function __construct(Id3Manager $id3Manager)
    {
        $this->id3Manager = $id3Manager;
    }


    public function onMfiFinderBeforeCollectionFilter(Event $event)
    {
        $id3Meta = new Id3Metadata($event->getFile()->getPathname());
        $this->id3Manager->read($id3Meta);
        $event->setId3metadata($id3Meta);
    }
}