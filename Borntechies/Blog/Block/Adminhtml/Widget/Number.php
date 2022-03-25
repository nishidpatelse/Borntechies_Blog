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

namespace Borntechies\Blog\Block\Adminhtml\Widget;

use Magento\Backend\Block\Widget\Grid\Column;
use Magento\Framework\Data\Form\Element\AbstractElement;

/**
 * Class Number
 * @package Borntechies\Blog\Block\Adminhtml\Widget
 */
class Number extends Column
{
    /**
     * @param AbstractElement $element
     *
     * @return AbstractElement
     */
    public function prepareElementHtml(AbstractElement $element)
    {
        $html = '<input type="text" name="' . $element->getName() . '" id="' . $element->getId()
            . '" class=" input-text admin__control-text required-entry _required validate-digits" value="'
            . $element->getValue() . '">';
        $element->setData('value', '');
        $element->setData('after_element_html', $html);

        return $element;
    }
}
