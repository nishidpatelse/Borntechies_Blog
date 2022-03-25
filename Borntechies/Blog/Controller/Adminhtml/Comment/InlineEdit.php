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

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Borntechies\Blog\Model\Comment;
use Borntechies\Blog\Model\CommentFactory;
use Borntechies\Blog\Model\Post;
use RuntimeException;

/**
 * Class InlineEdit
 * @package Borntechies\Blog\Controller\Adminhtml\Comment
 */
class InlineEdit extends Action
{
    /**
     * JSON Factory
     *
     * @var JsonFactory
     */
    public $jsonFactory;

    /**
     * Post Factory
     *
     * @var CommentFactory
     */
    public $commentFactory;

    /**
     * InlineEdit constructor.
     *
     * @param Context $context
     * @param JsonFactory $jsonFactory
     * @param CommentFactory $commentFactory
     */
    public function __construct(
        Context $context,
        JsonFactory $jsonFactory,
        CommentFactory $commentFactory
    ) {
        $this->jsonFactory = $jsonFactory;
        $this->commentFactory = $commentFactory;

        parent::__construct($context);
    }

    /**
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];
        $commentItems = $this->getRequest()->getParam('items', []);

        if (!($this->getRequest()->getParam('isAjax') && !empty($commentItems))) {
            return $resultJson->setData([
                'messages' => [
                    __('Please correct the data sent.')
                ],
                'error' => true,
            ]);
        }

        $key = array_keys($commentItems);
        $commentId = !empty($key) ? (int)$key[0] : '';

        /** @var Post $post */
        $comment = $this->commentFactory->create()->load($commentId);
        try {
            $commentData = $commentItems[$commentId];
            $comment->addData($commentData);
            $comment->save();
        } catch (LocalizedException $e) {
            $messages[] = $this->getErrorWithCommentId($comment, $e->getMessage());
            $error = true;
        } catch (RuntimeException $e) {
            $messages[] = $this->getErrorWithCommentId($comment, $e->getMessage());
            $error = true;
        } catch (Exception $e) {
            $messages[] = $this->getErrorWithCommentId(
                $comment,
                __('Something went wrong while saving the Comment.')
            );
            $error = true;
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }

    /**
     * @param Comment $comment
     * @param $errorText
     *
     * @return string
     */
    public function getErrorWithCommentId(Comment $comment, $errorText)
    {
        return '[Comment ID: ' . $comment->getId() . '] ' . $errorText;
    }
}
