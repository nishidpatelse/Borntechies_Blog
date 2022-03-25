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
use Borntechies\Blog\Api\Data\MonthlyArchiveInterface;

/**
 * Class MonthlyArchive
 * @package Borntechies\Blog\Model
 */
class MonthlyArchive extends DataObject implements MonthlyArchiveInterface
{
    /**
     * {@inheritdoc}
     */
    public function getLabel()
    {
        return $this->getData(self::LABEL);
    }

    /**
     * {@inheritdoc}
     */
    public function setLabel($value)
    {
        $this->setData(self::LABEL, $value);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPostCount()
    {
        return $this->getData(self::POST_COUNT);
    }

    /**
     * {@inheritdoc}
     */
    public function setPostCount($value)
    {
        $this->setData(self::POST_COUNT, $value);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getLink()
    {
        return $this->getData(self::LINK);
    }

    /**
     * {@inheritdoc}
     */
    public function setLink($value)
    {
        $this->setData(self::LINK, $value);

        return $this;
    }
}
