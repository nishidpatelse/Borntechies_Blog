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

namespace Borntechies\Blog\Api\Data\SearchResult;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface CommentSearchResultInterface
 * @api
 */
interface CommentSearchResultInterface extends SearchResultsInterface
{
    /**
     * @return \Borntechies\Blog\Api\Data\CommentInterface[]
     */
    public function getItems();

    /**
     * @param \Borntechies\Blog\Api\Data\CommentInterface[] $items
     * @return $this
     */
    public function setItems(array $items = null);
}
