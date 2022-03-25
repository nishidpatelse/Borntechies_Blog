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

namespace Borntechies\Blog\Controller\Author;

use Exception;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\ForwardFactory;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;
use Borntechies\Blog\Helper\Data as HelperData;
use Borntechies\Blog\Helper\Image;
use Borntechies\Blog\Model\AuthorFactory;

/**
 * Class View
 * @package Borntechies\Blog\Controller\Author
 */
class Register extends Action
{
    /**
     * @var PageFactory
     */
    public $resultPageFactory;

    /**
     * @var ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * @var HelperData
     */
    protected $_helperBlog;

    /**
     * @var Session
     */
    protected $customerSession;

    /**
     * @var Image
     */
    protected $imageHelper;

    /**
     * @var AuthorFactory
     */
    protected $author;

    /**
     * View constructor.
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param ForwardFactory $resultForwardFactory
     * @param Session $customerSession
     * @param Image $imageHelper
     * @param AuthorFactory $authorFactory
     * @param HelperData $helperData
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        ForwardFactory $resultForwardFactory,
        Session $customerSession,
        Image $imageHelper,
        AuthorFactory $authorFactory,
        HelperData $helperData
    ) {
        $this->_helperBlog = $helperData;
        $this->resultPageFactory = $resultPageFactory;
        $this->resultForwardFactory = $resultForwardFactory;
        $this->customerSession = $customerSession;
        $this->imageHelper = $imageHelper;
        $this->author = $authorFactory;

        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|Redirect|ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getParams();
        $this->_helperBlog->setCustomerContextId();

        if (!$this->_helperBlog->isEnabledAuthor()) {
            $resultRedirect->setPath('customer/account');

            return $resultRedirect;
        }

        if ($data) {
            if ($this->_helperBlog->isAuthor()) {
                $data = $this->prepareData($data);
                $author = $this->author->create()->addData($data);
                $notify = __('Register Successful');
            } else {
                $author = $this->_helperBlog->getCurrentAuthor();
                $data = $this->prepareData($data, $author);
                $author->addData($data);
                $notify = __('Author Edited Successful');
            }

            try {
                $author->save();
                $resultRedirect->setPath('blog/*/information');
                $this->messageManager->addSuccessMessage($notify);
            } catch (Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Author.'));
                $resultRedirect->setPath('blog/*/signup');
            }
        }

        return $resultRedirect;
    }

    /**
     * @param $data
     * @param null $author
     *
     * @return mixed
     */
    public function prepareData($data, $author = null)
    {
        if ($author) {
            unset($data['status']);
        } else {
            $data['customer_id'] = $this->customerSession->getId();
            $data['type'] = '1';
            $data['status'] = $this->_helperBlog->getConfigGeneral('auto_approve');
        }

        if ($this->getRequest()->getFiles()['image']['size'] > 0) {
            try {
                $this->imageHelper->uploadImage($data, 'image', Image::TEMPLATE_MEDIA_TYPE_AUTH);
            } catch (Exception $exception) {
                $data['image'] = isset($data['image']['value']) ? $data['image']['value'] : '';
            }
        }

        if (isset($data['image']['delete'])) {
            $data['image'] = '';
        }

        return $data;
    }
}
