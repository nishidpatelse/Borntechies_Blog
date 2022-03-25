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

use Exception;
use Magento\Framework\Controller\Result\Redirect;
use Borntechies\Blog\Controller\Adminhtml\Category;

/**
 * Class Delete
 * @package Borntechies\Blog\Controller\Adminhtml\Category
 */
class Delete extends Category
{
    /**
     * @return Redirect
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                $this->categoryFactory->create()
                    ->load($id)
                    ->delete();

                $this->messageManager->addSuccessMessage(__('The Blog Category has been deleted.'));

                $resultRedirect->setPath('borntechies_blog/*/');

                return $resultRedirect;
            } catch (Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                $resultRedirect->setPath('borntechies_blog/*/edit', ['id' => $id]);

                return $resultRedirect;
            }
        }

        // display error message
        $this->messageManager->addErrorMessage(__('Blog Category to delete was not found.'));
        // go to grid
        $resultRedirect->setPath('borntechies_blog/*/');

        return $resultRedirect;
    }
}
