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

namespace Borntechies\Blog\Controller\Adminhtml\Tag;

use Exception;
use Magento\Framework\Controller\Result\Redirect;
use Borntechies\Blog\Controller\Adminhtml\Tag;

/**
 * Class Delete
 * @package Borntechies\Blog\Controller\Adminhtml\Tag
 */
class Delete extends Tag
{
    /**
     * @return Redirect
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                $this->tagFactory->create()
                    ->load($id)
                    ->delete();
                $this->messageManager->addSuccessMessage(__('The Tag has been deleted.'));
            } catch (Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                $resultRedirect->setPath('borntechies_blog/*/edit', ['id' => $id]);

                return $resultRedirect;
            }
        } else {
            $this->messageManager->addErrorMessage(__('Tag to delete was not found.'));
        }

        $resultRedirect->setPath('borntechies_blog/*/');

        return $resultRedirect;
    }
}
