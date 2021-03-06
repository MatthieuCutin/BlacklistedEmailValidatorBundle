<?php
/*
 * This file is part of the BlacklistedEmailValidatorBundle project
 *
 * (c) Philipp Braeutigam <philipp.braeutigam@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xynnn\BlacklistedEmailValidatorBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('xynnn_blacklisted_email_validator');

        $rootNode
            ->children()
                ->booleanNode('strict')
            ->end();

        $rootNode
            ->children()
                ->arrayNode('hosts')
                    ->prototype('scalar')
                ->end()
            ->end();

        return $treeBuilder;
    }
}
