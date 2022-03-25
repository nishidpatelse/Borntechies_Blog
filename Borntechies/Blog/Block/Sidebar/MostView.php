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

namespace Borntechies\Blog\Block\Sidebar;

use Borntechies\Blog\Block\Frontend;
use Borntechies\Blog\Model\ResourceModel\Post\Collection;

/**
 * Class MostView
 * @package Borntechies\Blog\Block\Sidebar
 */
class MostView extends Frontend
{
    /**
     * @return Collection
     */
    public function getMostViewPosts()
    {
        $collection = $this->helperData->getPostList();
        $collection->getSelect()
            ->joinLeft(
                ['traffic' => $collection->getTable('borntechies_blog_post_traffic')],
                'main_table.post_id=traffic.post_id',
                'numbers_view'
            )
            ->order('numbers_view DESC')
            ->limit((int)$this->helperData->getBlogConfig('sidebar/number_mostview_posts') ?: 4);

        return $collection;
    }

    /**
     * @return Collection
     */
    public function getRecentPost()
    {
        $collection = $this->helperData->getPostList();
        $collection->getSelect()
            ->limit((int)$this->helperData->getBlogConfig('sidebar/number_recent_posts') ?: 4);

        return $collection;
    }
}
