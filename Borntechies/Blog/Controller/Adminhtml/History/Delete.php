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

namespace Borntechies\Blog\Controller\Adminhtml\History;

use Exception;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Borntechies\Blog\Controller\Adminhtml\History;

/**
 * Class Delete
 * @package Borntechies\Blog\Controller\Adminhtml\History
 */
class Delete extends History
{
    /**
     * @return ResponseInterface|Redirect|ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $postId = null;
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                $history = $this->postHistoryFactory->create()
                    ->load($id);
                $postId = $history->getPostId();
                $history->delete();

                $this->messageManager->addSuccessMessage(__('The Post History has been deleted.'));
            } catch (Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }
        } else {
            $this->messageManager->addErrorMessage(__('Post History to delete was not found.'));
        }
        if ($postId) {
            $resultRedirect->setPath('borntechies_blog/post/edit', ['id' => $postId]);
        } else {
            $resultRedirect->setPath('borntechies_blog/post/index');
        }

        return $resultRedirect;
    }
}
