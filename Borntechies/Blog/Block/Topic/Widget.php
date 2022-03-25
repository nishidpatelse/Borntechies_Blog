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

namespace Borntechies\Blog\Block\Topic;

use Exception;
use Borntechies\Blog\Model\ResourceModel\Author\Collection as AuthorCollection;
use Borntechies\Blog\Model\ResourceModel\Category\Collection as CategoryCollection;
use Borntechies\Blog\Model\ResourceModel\Post\Collection;
use Borntechies\Blog\Model\ResourceModel\Tag\Collection as TagCollection;
use Borntechies\Blog\Model\ResourceModel\Topic\Collection as TopicCollection;
use Borntechies\Blog\Block\Frontend;
use Borntechies\Blog\Helper\Data;
use Borntechies\Blog\Model\Topic;

/**
 * Class Widget
 * @package Borntechies\Blog\Block\Topic
 */
class Widget extends Frontend
{
    /**
     * @return AuthorCollection|CategoryCollection|Collection|TagCollection|TopicCollection|null
     */
    public function getTopicList()
    {
        try {
            return $this->helperData->getObjectList(Data::TYPE_TOPIC);
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * @param Topic $topic
     *
     * @return string
     */
    public function getTopicUrl($topic)
    {
        return $this->helperData->getBlogUrl($topic, Data::TYPE_TOPIC);
    }
}
