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

namespace Borntechies\Blog\Controller\Adminhtml\Comment;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Borntechies\Blog\Controller\Adminhtml\Comment;
use Borntechies\Blog\Model\CommentFactory;

/**
 * Class Edit
 * @package Borntechies\Blog\Controller\Adminhtml\Comment
 */
class Edit extends Comment
{
    /**
     * Page factory
     *
     * @var PageFactory
     */
    public $resultPageFactory;

    /**
     * Edit constructor.
     *
     * @param PageFactory $pageFactory
     * @param CommentFactory $commentFactory
     * @param Registry $coreRegistry
     * @param Context $context
     */
    public function __construct(
        PageFactory $pageFactory,
        CommentFactory $commentFactory,
        Registry $coreRegistry,
        Context $context
    ) {
        $this->resultPageFactory = $pageFactory;

        parent::__construct($commentFactory, $coreRegistry, $context);
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Page|Redirect|Page
     */
    public function execute()
    {
        /** @var \Borntechies\Blog\Model\Comment $comment */
        $comment = $this->initComment();

        if (!$comment) {
            $resultRedirect = $this->resultRedirectFactory->create();
            $resultRedirect->setPath('*');

            return $resultRedirect;
        }

        $data = $this->_session->getData('borntechies_blog_comment_data', true);

        if (!empty($data)) {
            $comment->setData($data);
        }

        $this->coreRegistry->register('borntechies_blog_comment', $comment);

        /** @var \Magento\Backend\Model\View\Result\Page|Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Borntechies_Blog::comment');

        $title = __('Edit Comment');
        $resultPage->getConfig()->getTitle()->prepend($title);

        return $resultPage;
    }
}
