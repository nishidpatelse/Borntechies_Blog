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

namespace Borntechies\Blog\Block;

use Magento\Framework\View\Element\Html\Links;

/**
 * Class Navigation
 * @package Borntechies\Blog\Block
 */
class Navigation extends Links
{
    /**
     * {@inheritdoc}
     */
    public function getLinks()
    {
        $links = parent::getLinks();

        usort($links, [$this, "compare"]);

        return $links;
    }

    /**
     * @param $firstLink
     * @param $secondLink
     *
     * @return bool
     */
    private function compare($firstLink, $secondLink)
    {
        return ($firstLink->getData('sortOrder') > $secondLink->getData('sortOrder'));
    }
}
