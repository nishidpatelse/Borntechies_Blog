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

namespace Borntechies\Blog\Model\Config;

use Magento\Framework\DataObject;
use Borntechies\Blog\Api\Data\Config\SidebarInterface;

/**
 * Class Sidebar
 * @package Borntechies\Blog\Model\Config
 */
class Sidebar extends DataObject implements SidebarInterface
{
    /**
     * {@inheritdoc}
     */
    public function getNumberRecent()
    {
        return $this->getData(self::NUMBER_RECENT);
    }

    /**
     * {@inheritdoc}
     */
    public function setNumberRecent($value)
    {
        $this->setData(self::NUMBER_RECENT, $value);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getNumberMostView()
    {
        return $this->getData(self::NUMBER_MOST_VIEW);
    }

    /**
     * {@inheritdoc}
     */
    public function setNumberMostView($value)
    {
        $this->setData(self::NUMBER_MOST_VIEW, $value);

        return $this;
    }
}
