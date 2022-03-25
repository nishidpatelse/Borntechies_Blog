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

namespace Borntechies\Blog\Block\Post;

use Borntechies\Blog\Block\Frontend;
use Borntechies\Blog\Helper\Data;

/**
 * Class ManagePost
 * @package Borntechies\Blog\Block\Post
 */
class ManagePost extends Frontend
{
    /**
     * @return string
     */
    public function getCategoriesTree()
    {
        return Data::jsonEncode($this->categoryOptions->getCategoriesTree());
    }

    /**
     * @return string
     */
    public function getTopicTree()
    {
        return Data::jsonEncode($this->topicOptions->getTopicsCollection());
    }

    /**
     * @return string
     */
    public function getTagTree()
    {
        return Data::jsonEncode($this->tagOptions->getTagsCollection());
    }

    /**
     * @return bool
     */
    public function checkTheme()
    {
        return $this->themeProvider->getThemeById($this->helperData->getCurrentThemeId())
                ->getCode() === 'Smartwave/porto';
    }
}
