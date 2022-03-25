<?php
/**
 * Born Techies Pvt. Ltd. 
 *
 * Born Techies Pvt. Ltd. serves customers all at one place who searches
 * for different types of extensions for Magento 2.
 * 
 * DISCLAIMER
 * 
 * 
 * Do not edit or add to this file if you wish to upgrade this
 * extension to newer 
 * version in the future.
 *
 * 
 * @category Born Techies Pvt. Ltd. 
 *
 * @package Borntechies_Blog
 * 
 * @copyright Copyright (c) Born Techies Pvt. Ltd. 
 * (https://borntechies.com/)
 * See COPYING.txt for license details.
 * 
 */

namespace Borntechies\Blog\Model;

use Magento\Framework\DataObject;
use Borntechies\Blog\Api\Data\BlogConfigInterface;

/**
 * Class BlogConfig
 * @package Borntechies\Blog\Model
 */
class BlogConfig extends DataObject implements BlogConfigInterface
{

    /**
     * {@inheritdoc}
     */
    public function getGeneral()
    {
        return $this->getData(self::GENERAL);
    }

    /**
     * {@inheritdoc}
     */
    public function setGeneral($value)
    {
        $this->setData(self::GENERAL, $value);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getSidebar()
    {
        return $this->getData(self::SIDEBAR);
    }

    /**
     * {@inheritdoc}
     */
    public function setSidebar($value)
    {
        $this->setData(self::SIDEBAR, $value);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getSeo()
    {
        return $this->getData(self::SEO);
    }

    /**
     * {@inheritdoc}
     */
    public function setSeo($value)
    {
        $this->setData(self::SEO, $value);

        return $this;
    }
}
