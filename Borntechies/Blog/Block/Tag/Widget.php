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

namespace Borntechies\Blog\Block\Tag;

use Exception;
use Magento\Framework\Exception\NoSuchEntityException;
use Borntechies\Blog\Block\Frontend;
use Borntechies\Blog\Helper\Data;
use Borntechies\Blog\Model\ResourceModel\Post\Collection;
use Borntechies\Blog\Model\ResourceModel\Author\Collection as AuthorCollection;
use Borntechies\Blog\Model\ResourceModel\Category\Collection as CategoryCollection;
use Borntechies\Blog\Model\ResourceModel\Tag\Collection as TagCollection;
use Borntechies\Blog\Model\ResourceModel\Topic\Collection as TopicCollection;
use Borntechies\Blog\Model\Tag;

/**
 * Class Widget
 * @package Borntechies\Blog\Block\Tag
 */
class Widget extends Frontend
{
    /**
     * @var TagCollection
     */
    protected $_tagList;

    /**
     * @return AuthorCollection|CategoryCollection|Collection|TagCollection|TopicCollection|null
     */
    public function getTagList()
    {
        try {
            if (!$this->_tagList) {
                $this->_tagList = $this->helperData->getObjectList(Data::TYPE_TAG);
            }

            return $this->_tagList;
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * @param Tag $tag
     *
     * @return string
     */
    public function getTagUrl($tag)
    {
        return $this->helperData->getBlogUrl($tag, Data::TYPE_TAG);
    }

    /**
     * Get tags size based on num of post
     *
     * @param $tag
     *
     * @return false|float|int
     * @throws NoSuchEntityException
     */
    public function getTagSize($tag)
    {
        /** @var Collection $postList */
        $postList = $this->helperData->getPostList();
        if ($postList && ($max = $postList->getSize()) > 1) {
            $maxSize = 22;
            $tagPost = $this->helperData->getPostCollection(Data::TYPE_TAG, $tag->getId());
            if ($tagPost && ($countTagPost = $tagPost->getSize()) > 1) {
                $size = $maxSize * $countTagPost / $max;

                return round($size) + 8;
            }
        }

        return 8;
    }
}
