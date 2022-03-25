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

namespace Borntechies\Blog\Block\Adminhtml\Post\Edit\Tab\Renderer\History;

use Exception;
use Magento\Backend\Block\Context;
use Magento\Framework\DataObject;
use Magento\Framework\Json\EncoderInterface;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class Action
 * @package Borntechies\Blog\Block\Adminhtml\Post\Edit\Tab\Renderer
 */
class Action extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\Action
{
    /**
     * @var StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * Action constructor.
     *
     * @param Context $context
     * @param StoreManagerInterface $storeManager
     * @param EncoderInterface $jsonEncoder
     * @param array $data
     */
    public function __construct(
        Context $context,
        StoreManagerInterface $storeManager,
        EncoderInterface $jsonEncoder,
        array $data = []
    ) {
        $this->_storeManager = $storeManager;
        parent::__construct($context, $jsonEncoder, $data);
    }

    /**
     * @param DataObject $row
     *
     * @return string
     */
    public function render(DataObject $row)
    {
        $actions[] = [
            'url' =>
                $this->getUrl('*/history/edit', [
                    'id' => $row->getId(),
                    'post_id' => $row->getPostId(),
                    'history' => true
                ]),
            'popup' => false,
            'caption' => __('Edit'),
        ];
        try {
            $actions[] = [
                'url' => $this->_storeManager->getStore()->getBaseUrl()
                    . 'blog/post/preview?id=' . $row->getPostId() . '&historyId=' . $row->getId(),
                'popup' => true,
                'caption' => __('Preview'),
            ];
        } catch (Exception $exception) {
            $actions[] = [];
        }
        $actions[] = [
            'url' =>
                $this->getUrl('*/history/restore', [
                    'id' => $row->getId(),
                    'post_id' => $row->getPostId()
                ]),
            'popup' => false,
            'caption' => __('Restore'),
            'confirm' => 'Are you sure you want to do this?'
        ];

        $actions[] = [
            'url' =>
                $this->getUrl('*/history/delete', [
                    'id' => $row->getId(),
                    'post_id' => $row->getPostId()
                ]),
            'popup' => false,
            'caption' => __('Delete'),
            'confirm' => 'Are you sure you want to do this?'
        ];

        $this->getColumn()->setActions($actions);

        return parent::render($row);
    }
}
