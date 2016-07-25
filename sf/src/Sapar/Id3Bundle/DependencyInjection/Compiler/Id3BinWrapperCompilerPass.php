<?php
namespace Sapar\Id3Bundle\DependencyInjection\Compiler;

use Sapar\Id3\Wrapper\Id3WrapperInterface;
use Sapar\Id3Bundle\DependencyInjection\Configuration;
use Sapar\Id3Bundle\Id3BinWrapperFactory;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

class Id3BinWrapperCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $wrapperIds = [Configuration::MEDIA_INFO, Configuration::EYED3, Configuration::ID3V2, Configuration::METAFLAC];
        foreach ($wrapperIds as $wrapperId) {
            $spaar_id3_wrapper = sprintf("sapar_id3.%s", $wrapperId);
            if ($container->hasParameter($spaar_id3_wrapper)) {
                $serviceParameters = $container->getParameter($spaar_id3_wrapper);
                $serviceDefinition = new Definition();
                $serviceDefinition->setClass(Id3WrapperInterface::class);
                $serviceDefinition->addArgument($wrapperId);
                $serviceDefinition->addArgument($serviceParameters['bin']);
                $serviceDefinition->setFactory([Id3BinWrapperFactory::class, 'createBinWrapper']);
                $container->setDefinition('sapar_id3.id3_bin_wrapper.'.$wrapperId, $serviceDefinition);
            }
        }
    }
}