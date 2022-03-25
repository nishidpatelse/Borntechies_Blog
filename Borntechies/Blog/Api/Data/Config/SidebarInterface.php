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

namespace Borntechies\Blog\Api\Data\Config;

/**
 * Interface SidebarInterface
 * @package Borntechies\Blog\Api\Data\Config
 */
interface SidebarInterface
{
    const NUMBER_RECENT    = 'number_recent';
    const NUMBER_MOST_VIEW = 'number_most_view';

    /**
     * @return string/null
     */
    public function getNumberRecent();

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setNumberRecent($value);

    /**
     * @return string/null
     */
    public function getNumberMostView();

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setNumberMostView($value);
}
