<?php
/*
 * WellCommerce Open-Source E-Commerce Platform
 *
 * This file is part of the WellCommerce package.
 *
 * (c) Adam Piotrowski <adam@wellcommerce.org>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace WellCommerce\Bundle\LayoutBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use WellCommerce\Bundle\CoreBundle\DependencyInjection\AbstractExtension;

/**
 * Class WellCommerceLocaleExtension
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class WellCommerceLayoutExtension extends AbstractExtension
{
    CONST EXTENSION_NAME = 'well_commerce_layout';

    /**
     * {@inheritdoc}
     */
    protected function setExtensionConfiguration(ContainerBuilder $container, array $parameters = [])
    {
        $container->setParameter(self::EXTENSION_NAME, $parameters);
    }
}
