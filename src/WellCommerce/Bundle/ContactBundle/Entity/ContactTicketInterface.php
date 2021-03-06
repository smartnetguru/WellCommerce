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

namespace WellCommerce\Bundle\ContactBundle\Entity;

use WellCommerce\Bundle\DoctrineBundle\Entity\IdentifiableEntityInterface;

/**
 * Class ReviewInterface
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
interface ContactTicketInterface extends IdentifiableEntityInterface
{
    /**
     * @return string
     */
    public function getSubject() : string;

    /**
     * @param string $subject
     */
    public function setSubject(string $subject);

    /**
     * @return string
     */
    public function getEmail() : string;

    /**
     * @param string $email
     */
    public function setEmail(string $email);

    /**
     * @return string
     */
    public function getContent() : string;

    /**
     * @param string $content
     */
    public function setContent(string $content);
}
