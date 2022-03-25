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

namespace Borntechies\Blog\Model\Config\Source\Import;

use Magento\Framework\Option\ArrayInterface;

/**
 * Class Type
 * @package Borntechies\Blog\Model\Config\Source\Import
 */
class Type implements ArrayInterface
{
    const WORDPRESS = "wordpress";
    const AHEADWORK = "aheadworksm1";
    const MAGEFAN = "magefan";

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options = [];
        foreach ($this->toArray() as $value => $label) {
            $options[] = [
                'value' => $value,
                'label' => $label
            ];
        }

        return $options;
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return [
            "" => __('-- Please Select --'),
            self::WORDPRESS => __('Wordpress'),
            self::AHEADWORK => __('AheadWorks Blog [Magento 1]'),
            self::MAGEFAN => __('MageFan Blog [Magento 2]')
        ];
    }
}
