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

namespace Borntechies\Blog\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Borntechies\Blog\Model\TagFactory;

/**
 * Class Tag
 * @package Borntechies\Blog\Controller\Adminhtml
 */
abstract class Tag extends Action
{
    /** Authorization level of a basic admin session */
    const ADMIN_RESOURCE = 'Borntechies_Blog::tag';

    /**
     * Tag Factory
     *
     * @var TagFactory
     */
    public $tagFactory;

    /**
     * Core registry
     *
     * @var Registry
     */
    public $coreRegistry;

    /**
     * Tag constructor.
     *
     * @param Context $context
     * @param Registry $coreRegistry
     * @param TagFactory $tagFactory
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        TagFactory $tagFactory
    ) {
        $this->tagFactory = $tagFactory;
        $this->coreRegistry = $coreRegistry;

        parent::__construct($context);
    }

    /**
     * @param bool $register
     *
     * @return bool|\Borntechies\Blog\Model\Tag
     */
    protected function initTag($register = false)
    {
        $tagId = (int)$this->getRequest()->getParam('id');

        /** @var \Borntechies\Blog\Model\Tag $tag */
        $tag = $this->tagFactory->create();
        if ($tagId) {
            $tag->load($tagId);
            if (!$tag->getId()) {
                $this->messageManager->addErrorMessage(__('This tag no longer exists.'));

                return false;
            }
        }

        if ($register) {
            $this->coreRegistry->register('borntechies_blog_tag', $tag);
        }

        return $tag;
    }
}
