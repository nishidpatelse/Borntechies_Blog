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

namespace Borntechies\Blog\Block\Adminhtml\Category\Edit;

use Exception;
use Magento\Backend\Block\Template\Context;
use Magento\Backend\Model\Auth\Session;
use Magento\Framework\Json\EncoderInterface;
use Magento\Framework\Registry;
use Borntechies\Blog\Model\Category;

/**
 * Class Tabs
 * @package Borntechies\Blog\Block\Adminhtml\Category\Edit
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * @var string
     */
    protected $_template = 'Magento_Backend::widget/tabshoriz.phtml';

    /**
     * @var Registry
     */
    public $coreRegistry;

    /**
     * Tabs constructor.
     *
     * @param Registry $coreRegistry
     * @param Context $context
     * @param EncoderInterface $jsonEncoder
     * @param Session $authSession
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        EncoderInterface $jsonEncoder,
        Session $authSession,
        array $data = []
    ) {
        $this->coreRegistry = $coreRegistry;

        parent::__construct($context, $jsonEncoder, $authSession, $data);
    }

    /**
     * Initialize Tabs
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('category_info_tabs');
        $this->setDestElementId('category_tab_content');
        $this->setTitle(__('Category Data'));
    }

    /**
     * Retrieve Blog Category object
     *
     * @return Category
     */
    public function getCategory()
    {
        return $this->coreRegistry->registry('category');
    }

    /**
     * @inheritdoc
     * @throws Exception
     */
    protected function _prepareLayout()
    {
        $this->addTab('category', [
            'label' => __('Category information'),
            'content' => $this->getLayout()
                ->createBlock(
                    Tab\Category::class,
                    'borntechies_blog_category_edit_tab_category'
                )
                ->toHtml()
        ]);
        $this->addTab('post', [
            'label' => __('Posts'),
            'content' => $this->getLayout()
                ->createBlock(
                    Tab\Post::class,
                    'borntechies_blog_category_edit_tab_post'
                )
                ->toHtml()
        ]);

        // dispatch event add custom tabs
        $this->_eventManager->dispatch('adminhtml_borntechies_blog_category_tabs', ['tabs' => $this]);

        return parent::_prepareLayout();
    }
}
