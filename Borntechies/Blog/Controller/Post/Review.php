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

namespace Borntechies\Blog\Controller\Post;

use Exception;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Borntechies\Blog\Helper\Data;
use Borntechies\Blog\Model\PostFactory;
use Borntechies\Blog\Model\PostLikeFactory;
use Borntechies\Blog\Model\ResourceModel\PostLike\Collection;

/**
 * Class Review
 * @package Borntechies\Blog\Controller\Post
 */
class Review extends Action
{

    /**
     * @var Data
     */
    protected $_helperBlog;

    /**
     * @var PostFactory
     */
    protected $postFactory;

    /**
     * @var PostLike
     */
    protected $_postLike;

    /**
     * @var Collection
     */
    protected $_postLikeCollection;

    /**
     * Review constructor.
     *
     * @param Context $context
     * @param PostFactory $postFactory
     * @param Collection $postLikeCollection
     * @param PostLikeFactory $postLikeFactory
     * @param Data $helperData
     */
    public function __construct(
        Context $context,
        PostFactory $postFactory,
        Collection $postLikeCollection,
        PostLikeFactory $postLikeFactory,
        Data $helperData
    ) {
        $this->_helperBlog = $helperData;
        $this->_postLikeCollection = $postLikeCollection;
        $this->_postLike = $postLikeFactory;
        $this->postFactory = $postFactory;

        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|ResultInterface
     * @throws Exception
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('post_id');
        $action = $this->getRequest()->getParam('action');
        $mode = $this->getRequest()->getParam('mode');
        $likeId = $this->getRequest()->getParam('likeId');
        $customerId = $this->_helperBlog->getCurrentUser() ?: 0;
        $post = $this->postFactory->create()->load($id);

        if ($mode === '1') {
            $like = $this->_postLikeCollection->addFieldToFilter('entity_id', $customerId)
                ->addFieldToFilter('post_id', $post->getId());
            $likeId = $like->getFirstItem()->getId();

            if ($action === '3') {
                return $this->getResponse()->representJson(Data::jsonEncode([
                    'status' => $like->count() > 0 ? 0 : 1,
                    'action' => $like->getFirstItem()->getAction(),
                    'type' => $action
                ]));
            }

            if (!$customerId || !$post) {
                if ($action === '1') {
                    $this->messageManager->addErrorMessage(__('Can\'t Like Post.'));
                } else {
                    $this->messageManager->addErrorMessage(__('Can\'t Dislike Post.'));
                }

                return $this->getResponse()->representJson(Data::jsonEncode([
                    'status' => 0,
                    'type' => $action
                ]));
            }
        }

        try {
            $postLike = $this->_postLike->create()->load($likeId);

            if ($postLike->getId() && $postLike->getAction() === $action) {
                $postLike->delete();
                $postLike->setId(0);
            } else {
                $postLike->addData(
                    [
                        'post_id' => $post->getId(),
                        'action' => $action,
                        'entity_id' => $customerId
                    ]
                )->save();
            }

            $sumLike = $this->_postLike->create()->getCollection()->addFieldToFilter('action', '1')
                ->addFieldToFilter('post_id', $id);
            $sumDislike = $this->_postLike->create()->getCollection()->addFieldToFilter('action', '0')
                ->addFieldToFilter('post_id', $id);

            return $this->getResponse()->representJson(Data::jsonEncode([
                'status' => 1,
                'type' => $action,
                'sumLike' => $sumLike->count(),
                'sumDislike' => $sumDislike->count(),
                'postLike' => $postLike->getId()
            ]));
        } catch (Exception $exception) {
            $this->messageManager->addErrorMessage($exception->getMessage());

            return $this->getResponse()->representJson(Data::jsonEncode([
                'status' => 0,
                'type' => $action
            ]));
        }
    }
}
