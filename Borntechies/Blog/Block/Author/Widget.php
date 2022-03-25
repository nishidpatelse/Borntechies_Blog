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

namespace Borntechies\Blog\Block\Author;

use Borntechies\Blog\Block\Frontend;
use Borntechies\Blog\Helper\Data;

/**
 * Class Widget
 * @package Borntechies\Blog\Block\Author
 */
class Widget extends Frontend
{
    /**
     * @return mixed
     */
    public function getCurrentAuthor()
    {
        $authorId = $this->getRequest()->getParam('id');
        if ($authorId) {
            $author = $this->helperData->getObjectByParam($authorId, null, Data::TYPE_AUTHOR);
            if ($author && $author->getId()) {
                return $author;
            }
        }

        return null;
    }
}
