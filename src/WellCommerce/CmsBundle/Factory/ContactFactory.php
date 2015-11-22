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

namespace WellCommerce\CmsBundle\Factory;

use WellCommerce\CmsBundle\Entity\Contact;
use WellCommerce\CoreBundle\Factory\AbstractFactory;

/**
 * Class ContactFactory
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class ContactFactory extends AbstractFactory
{
    /**
     * @return \WellCommerce\CmsBundle\Entity\ContactInterface
     */
    public function create()
    {
        $contact = new Contact();
        $contact->setCreatedAt(new \DateTime());

        return $contact;
    }
}