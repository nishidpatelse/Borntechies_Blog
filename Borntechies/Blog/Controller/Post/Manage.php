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
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\ForwardFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Registry;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Framework\View\Result\PageFactory;
use Borntechies\Blog\Helper\Data;
use Borntechies\Blog\Helper\Image;
use Borntechies\Blog\Model\PostFactory;
use Borntechies\Blog\Model\ResourceModel\Author\Collection as AuthorCollection;

/**
 * Class Manage
 * @package Borntechies\Blog\Controller\Post
 */
class Manage extends Action
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
     * @var Data
     */
    protected $_helperBlog;

    /**
     * @var AuthorCollection
     */
    protected $authorCollection;

    /**
     * @var Session
     */
    protected $customerSession;

    /**
     * @var Registry
     */
    protected $coreRegistry;

    /**
     * @var PostFactory
     */
    protected $postFactory;

    /**
     * @var DateTime
     */
    protected $date;

    /**
     * @var Image
     */
    protected $imageHelper;

    /**
     * View constructor.
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param ForwardFactory $resultForwardFactory
     * @param PostFactory $postFactory
     * @param AuthorCollection $authorCollection
     * @param Session $customerSession
     * @param Registry $coreRegistry
     * @param DateTime $date
     * @param Image $imageHelper
     * @param Data $helperData
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        ForwardFactory $resultForwardFactory,
        PostFactory $postFactory,
        AuthorCollection $authorCollection,
        Session $customerSession,
        Registry $coreRegistry,
        DateTime $date,
        Image $imageHelper,
        Data $helperData
    ) {
        $this->_helperBlog = $helperData;
        $this->resultPageFactory = $resultPageFactory;
        $this->resultForwardFactory = $resultForwardFactory;
        $this->authorCollection = $authorCollection;
        $this->customerSession = $customerSession;
        $this->coreRegistry = $coreRegistry;
        $this->postFactory = $postFactory;
        $this->date = $date;
        $this->imageHelper = $imageHelper;

        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|ResultInterface|null
     * @throws NoSuchEntityException
     */
    public function execute()
    {
        $data = $this->getRequest()->getParams();
        $this->_helperBlog->setCustomerContextId();
        $author = $this->_helperBlog->getCurrentAuthor();
        $post = $this->postFactory->create();

        if (!$author) {
            return null;
        }

        if ($this->getRequest()->getFiles('image')['size'] > 0) {
            try {
                $this->imageHelper->uploadImage($data, 'image', Image::TEMPLATE_MEDIA_TYPE_POST, $post->getImage());
            } catch (Exception $exception) {
                $data['image'] = isset($data['image']['value']) ? $data['image']['value'] : '';
            }
        }

        if (isset($data['image']['delete']) || (isset($data['image']) && $data['image'] === 'null')) {
            $data['image'] = '';
        }

        $data['categories_ids'] = (isset($data['categories_ids']) && $data['categories_ids']) ? explode(
            ',',
            $data['categories_ids']
        ) : [];
        $data['tags_ids'] = (isset($data['tags_ids']) && $data['tags_ids'])
            ? explode(',', $data['tags_ids']) : [];
        $data['topics_ids'] = (isset($data['topics_ids']) && $data['topics_ids']) ? explode(
            ',',
            $data['topics_ids']
        ) : [];

        $data['author_id'] = $author->getId();

        $data['store_ids'] = $this->_helperBlog->getCurrentStoreId();

        $data['enabled'] = $this->_helperBlog->getConfigGeneral('auto_post') ? 1 : 0;

        $data['in_rss'] = '0';

        $data['meta_robots'] = 'INDEX,FOLLOW';

        $data['layout'] = 'empty';

        $data['publish_date'] = !empty($data['publish_date']) ? $data['publish_date'] : $this->date->date();

        if ($data['post_id']) {
            $post->load($data['post_id']);
            if ($post->getId()) {
                $post->setData($data);
            }
            $data['updated_at'] = $this->date->date();
        } else {
            unset($data['post_id']);
            $data['created_at'] = $this->date->date();
            $post->setData($data);
        }

        try {
            $post->save();
            $this->messageManager->addSuccessMessage(__('The post has been saved.'));

            return $this->getResponse()->representJson(Data::jsonEncode([
                'status' => 1
            ]));
        } catch (Exception $exception) {
            $this->messageManager->addErrorMessage($exception->getMessage());

            return $this->getResponse()->representJson(Data::jsonEncode([
                'status' => 0
            ]));
        }
    }
}
