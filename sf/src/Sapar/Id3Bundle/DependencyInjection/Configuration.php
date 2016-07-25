<?php

namespace Sapar\Id3Bundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    const MEDIA_INFO    = 'media_info';
    const EYED3         = 'eyed3';
    const ID3V2         = 'id3v2';
    const METAFLAC      = 'metaflac';
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('sapar_id3');

        $rootNode
            ->children()
                ->arrayNode(self::MEDIA_INFO)
                        ->children()
                            ->scalarNode('bin')
                            ->end()
                        ->end()
                ->end()
                ->arrayNode(self::EYED3)
                        ->children()
                            ->scalarNode('bin')
                            ->end()
                        ->end()
                ->end()
                ->arrayNode(self::ID3V2)
                        ->children()
                            ->scalarNode('bin')
                            ->end()
                        ->end()
                ->end()
                ->arrayNode(self::METAFLAC)
                        ->children()
                            ->scalarNode('bin')
                            ->end()
                        ->end()
                ->end()
        ;

        return $treeBuilder;
    }
}
