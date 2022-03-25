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
use Magento\Framework\Stdlib\DateTime\DateTime;
use Borntechies\Blog\Model\PostFactory;
use Borntechies\Blog\Model\PostHistory;
use Borntechies\Blog\Model\PostHistoryFactory;

/**
 * Class Post
 * @package Borntechies\Blog\Controller\Adminhtml
 */
abstract class History extends Action
{
    /** Authorization level of a basic admin session */
    const ADMIN_RESOURCE = 'Borntechies_Blog::post';

    /**
     * Post History Factory
     *
     * @var PostHistoryFactory
     */
    public $postHistoryFactory;

    /**
     * Core registry
     *
     * @var Registry
     */
    public $coreRegistry;

    /**
     * @var PostFactory
     */
    protected $postFactory;

    /**
     * @var DateTime
     */
    protected $date;

    /**
     * Post constructor.
     *
     * @param PostHistoryFactory $postHistoryFactory
     * @param PostFactory $postFactory
     * @param Registry $coreRegistry
     * @param DateTime $date
     * @param Context $context
     */
    public function __construct(
        PostHistoryFactory $postHistoryFactory,
        PostFactory $postFactory,
        Registry $coreRegistry,
        DateTime $date,
        Context $context
    ) {
        $this->postHistoryFactory = $postHistoryFactory;
        $this->postFactory = $postFactory;
        $this->coreRegistry = $coreRegistry;
        $this->date = $date;

        parent::__construct($context);
    }

    /**
     * @param bool $register
     *
     * @return bool|PostHistory
     */
    protected function initPostHistory($register = false)
    {
        $historyId = (int)$this->getRequest()->getParam('id');

        /** @var \Borntechies\Blog\Model\Post $post */
        $history = $this->postHistoryFactory->create();
        if ($historyId) {
            $history->load($historyId);
            if (!$history->getId()) {
                $this->messageManager->addErrorMessage(__('This History no longer exists.'));

                return false;
            }
        }

        if ($register) {
            $this->coreRegistry->register('borntechies_blog_post_history', $history);
        }

        return $history;
    }
}
