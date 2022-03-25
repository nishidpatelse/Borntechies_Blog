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

namespace Borntechies\Blog\Api\Data;

/**
 * Interface BlogConfigInterface
 * @package Borntechies\Blog\Api\Data
 */
interface BlogConfigInterface
{
    const GENERAL = 'general';
    const SIDEBAR = 'sidebar';
    const SEO     = 'seo';

    /**
     * @return \Borntechies\Blog\Api\Data\Config\GeneralInterface
     */
    public function getGeneral();

    /**
     * @param \Borntechies\Blog\Api\Data\Config\GeneralInterface $value
     *
     * @return $this
     */
    public function setGeneral($value);

    /**
     * @return \Borntechies\Blog\Api\Data\Config\SidebarInterface
     */
    public function getSidebar();

    /**
     * @param \Borntechies\Blog\Api\Data\Config\SidebarInterface $value
     *
     * @return $this
     */
    public function setSidebar($value);

    /**
     * @return \Borntechies\Blog\Api\Data\Config\SeoInterface
     */
    public function getSeo();

    /**
     * @param \Borntechies\Blog\Api\Data\Config\SeoInterface $value
     *
     * @return $this
     */
    public function setSeo($value);
}
