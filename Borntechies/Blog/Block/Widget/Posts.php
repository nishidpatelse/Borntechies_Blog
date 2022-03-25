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

namespace Borntechies\Blog\Block\Widget;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Widget\Block\BlockInterface;
use Borntechies\Blog\Block\Frontend;
use Borntechies\Blog\Helper\Data;
use Borntechies\Blog\Model\ResourceModel\Post\Collection;

/**
 * Class Posts
 * @package Borntechies\Blog\Block\Widget
 */
class Posts extends Frontend implements BlockInterface
{
    /**
     * @var string
     */
    protected $_template = "widget/posts.phtml";

    /**
     * @return Collection
     * @throws NoSuchEntityException
     */
    public function getCollection()
    {
        if ($this->hasData('show_type') && $this->getData('show_type') === 'category') {
            $collection = $this->helperData->getObjectByParam($this->getData('category_id'), null, Data::TYPE_CATEGORY)
                ->getSelectedPostsCollection();
            $this->helperData->addStoreFilter($collection);
        } else {
            $collection = $this->helperData->getPostList();
        }

        $collection->setPageSize($this->getData('post_count'));

        return $collection;
    }

    /**
     * @return Data
     */
    public function getHelperData()
    {
        return $this->helperData;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->getData('title');
    }

    /**
     * @param $code
     *
     * @return string
     */
    public function getBlogUrl($code)
    {
        return $this->helperData->getBlogUrl($code);
    }
}
