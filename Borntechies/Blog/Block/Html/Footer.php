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

namespace Borntechies\Blog\Block\Html;

use Magento\Framework\View\Element\Html\Link;
use Magento\Framework\View\Element\Template\Context;
use Borntechies\Blog\Helper\Data;

/**
 * Class Footer
 * @package Borntechies\Blog\Block\Html
 */
class Footer extends Link
{
    /**
     * @var Data
     */
    public $helper;

    /**
     * @var string
     */
    protected $_template = 'Borntechies_Blog::html\footer.phtml';

    /**
     * Footer constructor.
     *
     * @param Context $context
     * @param Data $helper
     * @param array $data
     */
    public function __construct(
        Context $context,
        Data $helper,
        array $data = []
    ) {
        $this->helper = $helper;

        parent::__construct($context, $data);
    }

    /**
     * @return string
     */
    public function getHref()
    {
        return $this->helper->getBlogUrl('');
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->helper->getBlogConfig('general/name') ? : __('Blog');
    }

    /**
     * @return string
     */
    public function getHtmlSiteMapUrl()
    {
        return $this->helper->getBlogUrl('sitemap');
    }

    /**
     * @return Data
     */
    public function getHelperData()
    {
        return $this->helper;
    }
}
