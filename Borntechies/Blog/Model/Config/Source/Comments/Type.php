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

namespace Borntechies\Blog\Model\Config\Source\Comments;

use Magento\Framework\Option\ArrayInterface;

/**
 * Class Type
 * @package Borntechies\Blog\Model\Config\Source\Comments
 */
class Type implements ArrayInterface
{
    const DEFAULT_COMMENT = 1;
    const FACEBOOK = 2;
    const DISQUS = 3;
    const DISABLE = 4;

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
            self::DEFAULT_COMMENT => __('Default Comment'),
            self::DISQUS => __('Disqus Comment'),
            self::FACEBOOK => __('Facebook Comment'),
            self::DISABLE => __('Disable Completely')
        ];
    }
}
