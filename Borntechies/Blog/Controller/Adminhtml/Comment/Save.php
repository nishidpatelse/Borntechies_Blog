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
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Exception\LocalizedException;
use Borntechies\Blog\Controller\Adminhtml\Comment;
use RuntimeException;

/**
 * Class Save
 * @package Borntechies\Blog\Controller\Adminhtml\Comment
 */
class Save extends Comment
{
    /**
     * @return Redirect
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($data = $this->getRequest()->getPost('comment')) {
            /** @var \Borntechies\Blog\Model\Comment $post */
            $comment = $this->initComment();

            $this->prepareData($comment, $data);

            $this->_eventManager->dispatch(
                'borntechies_blog_comment_prepare_save',
                ['comment' => $comment, 'request' => $this->getRequest()]
            );

            try {
                $comment->save();

                $this->messageManager->addSuccessMessage(__('The comment has been saved.'));
                $this->_getSession()->setData('borntechies_blog_comment_data', false);

                if ($this->getRequest()->getParam('back')) {
                    $resultRedirect->setPath('borntechies_blog/*/edit', ['id' => $comment->getId(), '_current' => true]);
                } else {
                    $resultRedirect->setPath('borntechies_blog/*/');
                }

                return $resultRedirect;
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (RuntimeException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Comment.'));
            }

            $this->_getSession()->setData('borntechies_blog_comment_data', $data);

            $resultRedirect->setPath('borntechies_blog/*/edit', ['id' => $comment->getId(), '_current' => true]);

            return $resultRedirect;
        }

        $resultRedirect->setPath('borntechies_blog/*/');

        return $resultRedirect;
    }

    /**
     * @param $comment
     * @param array $data
     *
     * @return $this
     */
    protected function prepareData($comment, $data = [])
    {
        $comment->addData($data);

        return $this;
    }
}
