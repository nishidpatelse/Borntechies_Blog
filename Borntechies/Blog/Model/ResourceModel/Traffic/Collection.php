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

namespace Borntechies\Blog\Model\ResourceModel\Traffic;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Borntechies\Blog\Model\Traffic;
use Borntechies\Blog\Model\ResourceModel\Traffic as TrafficResourceModel;

/**
 * Class Collection
 * @package Borntechies\Blog\Model\ResourceModel\Traffic
 */
class Collection extends AbstractCollection
{
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(Traffic::class, TrafficResourceModel::class);
    }
}
