<?php

namespace Sapar\Id3Bundle;

use Sapar\Id3Bundle\DependencyInjection\Compiler\Id3BinWrapperCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class SaparId3Bundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new Id3BinWrapperCompilerPass());
    }

}
