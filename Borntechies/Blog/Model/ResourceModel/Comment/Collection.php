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

namespace Borntechies\Blog\Model\ResourceModel\Comment;

use Magento\Sales\Model\ResourceModel\Collection\AbstractCollection;
use Borntechies\Blog\Api\Data\SearchResult\CommentSearchResultInterface;
use Borntechies\Blog\Model\Comment;

/**
 * Class Collection
 * @package Borntechies\Blog\Model\ResourceModel\Comment
 */
class Collection extends AbstractCollection implements CommentSearchResultInterface
{
    /**
     * @var string
     */
    protected $_idFieldName = 'comment_id';

    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(Comment::class, \Borntechies\Blog\Model\ResourceModel\Comment::class);
    }
}
