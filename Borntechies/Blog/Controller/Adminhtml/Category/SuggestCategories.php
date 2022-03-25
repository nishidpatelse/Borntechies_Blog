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

namespace Borntechies\Blog\Controller\Adminhtml\Category;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Registry;
use Magento\Framework\View\LayoutFactory;
use Borntechies\Blog\Block\Adminhtml\Category\Tree;
use Borntechies\Blog\Controller\Adminhtml\Category;
use Borntechies\Blog\Model\CategoryFactory;

/**
 * Class SuggestCategories
 * @package Borntechies\Blog\Controller\Adminhtml\Category
 */
class SuggestCategories extends Category
{
    /**
     * Json result factory
     *
     * @var JsonFactory
     */
    public $resultJsonFactory;

    /**
     * Layout factory
     *
     * @var LayoutFactory
     */
    public $layoutFactory;

    /**
     * SuggestCategories constructor.
     *
     * @param Context $context
     * @param Registry $coreRegistry
     * @param CategoryFactory $categoryFactory
     * @param JsonFactory $resultJsonFactory
     * @param LayoutFactory $layoutFactory
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        CategoryFactory $categoryFactory,
        JsonFactory $resultJsonFactory,
        LayoutFactory $layoutFactory
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->layoutFactory     = $layoutFactory;

        parent::__construct($context, $coreRegistry, $categoryFactory);
    }

    /**
     * Blog Category list suggestion based on already entered symbols
     *
     * @return Json
     */
    public function execute()
    {
        /** @var Tree $treeBlock */
        $treeBlock = $this->layoutFactory->create()->createBlock(Tree::class);
        $data      = $treeBlock->getSuggestedCategoriesJson($this->getRequest()->getParam('label_part'));

        /** @var Json $resultJson */
        $resultJson = $this->resultJsonFactory->create();
        $resultJson->setJsonData($data);

        return $resultJson;
    }
}
