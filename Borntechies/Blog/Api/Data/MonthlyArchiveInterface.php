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
 * Interface MonthlyArchiveInterface
 * @package Borntechies\Blog\Api\Data
 */
interface MonthlyArchiveInterface
{
    const LABEL      = 'label';
    const POST_COUNT = 'post_count';
    const LINK       = 'link';

    /**
     * @return string
     */
    public function getLabel();

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setLabel($value);

    /**
     * @return int
     */
    public function getPostCount();

    /**
     * @param int $value
     *
     * @return $this
     */
    public function setPostCount($value);

    /**
     * @return string
     */
    public function getLink();

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setLink($value);
}
