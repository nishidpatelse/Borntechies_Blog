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
use Borntechies\Blog\Model\PostFactory;

/**
 * Class Post
 * @package Borntechies\Blog\Controller\Adminhtml
 */
abstract class Post extends Action
{
    /** Authorization level of a basic admin session */
    const ADMIN_RESOURCE = 'Borntechies_Blog::post';

    /**
     * Post Factory
     *
     * @var PostFactory
     */
    public $postFactory;

    /**
     * Core registry
     *
     * @var Registry
     */
    public $coreRegistry;

    /**
     * Post constructor.
     *
     * @param PostFactory $postFactory
     * @param Registry $coreRegistry
     * @param Context $context
     */
    public function __construct(
        PostFactory $postFactory,
        Registry $coreRegistry,
        Context $context
    ) {
        $this->postFactory = $postFactory;
        $this->coreRegistry = $coreRegistry;

        parent::__construct($context);
    }

    /**
     * @param bool $register
     * @param bool $isSave
     *
     * @return bool|\Borntechies\Blog\Model\Post
     */
    protected function initPost($register = false, $isSave = false)
    {
        $postId = (int)$this->getRequest()->getParam('id');
        $duplicate = $this->getRequest()->getParam('post')['duplicate'] ?? null;

        /** @var \Borntechies\Blog\Model\Post $post */
        $post = $this->postFactory->create();
        if ($postId) {
            if (!$isSave || !$duplicate) {
                $post->load($postId);
                if (!$post->getId()) {
                    $this->messageManager->addErrorMessage(__('This post no longer exists.'));

                    return false;
                }
            }
        }

        if (!$post->getAuthorId()) {
            $post->setAuthorId($this->_auth->getUser()->getId());
        }

        if ($register) {
            $this->coreRegistry->register('borntechies_blog_post', $post);
        }

        return $post;
    }
}
