<?php

namespace Sapar\Id3Bundle;

use Sapar\Id3\Wrapper\BinWrapper\BinWrapperInterface;
use Sapar\Id3\Wrapper\BinWrapper\Eyed3Wrapper;
use Sapar\Id3\Wrapper\BinWrapper\Id3v2Wrapper;
use Sapar\Id3\Wrapper\BinWrapper\MediainfoWrapper;
use Sapar\Id3\Wrapper\BinWrapper\MetaflacWrapper;
use Sapar\Id3Bundle\DependencyInjection\Configuration;

class Id3BinWrapperFactory
{
    /**
     * @param $bin
     * @return BinWrapperInterface
     */
    public static function createBinWrapper($wrapperId, $bin)
    {
        $wrapper = new Id3v2Wrapper();
        if ($wrapperId === Configuration::EYED3) {
            $wrapper =new Eyed3Wrapper();
        }
        if ($wrapperId === Configuration::MEDIA_INFO) {
            $wrapper = new MediainfoWrapper();
        }
        if ($wrapperId === Configuration::METAFLAC) {
            $wrapper = new MetaflacWrapper();
        }

        $wrapper->setBinPath($bin);

        return $wrapper;
    }
}
