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

namespace Borntechies\Blog\Block\Adminhtml\Author;

use Magento\Backend\Block\Widget\Context;
use Magento\Backend\Block\Widget\Form\Container;
use Magento\Framework\Registry;
use Borntechies\Blog\Model\Author;

/**
 * Class Edit
 * @package Borntechies\Blog\Block\Adminhtml\Author
 */
class Edit extends Container
{
    /**
     * @var Registry
     */
    public $coreRegistry;

    /**
     * Edit constructor.
     *
     * @param Context $context
     * @param Registry $coreRegistry
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        array $data = []
    ) {
        $this->coreRegistry = $coreRegistry;

        parent::__construct($context, $data);
    }

    /**
     * Initialize Post edit block
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'user_id';
        $this->_blockGroup = 'Borntechies_Blog';
        $this->_controller = 'adminhtml_author';

        parent::_construct();

        $this->buttonList->add('save-and-continue', [
            'label' => __('Save And Continue Edit'),
            'data_attribute' => [
                'mage-init' => [
                    'button' => [
                        'event' => 'saveAndContinueEdit',
                        'target' => '#edit_form'
                    ]
                ]
            ]
        ], -100);

        $this->buttonList->add(
            'delete',
            [
                'label' => __('Delete'),
                'class' => 'delete',
                'onclick' => "setLocation('{$this->getUrl('borntechies_blog/author/delete', [
                    'id' => $this->getCurrentAuthor()->getId(),
                    '_current' => true,
                    'back' => 'edit'
                ])}')",
            ],
            -101
        );
    }

    /**
     * Retrieve text for header element depending on loaded Post
     *
     * @return string
     */
    public function getHeaderText()
    {
        /** @var Author $author */
        $author = $this->getCurrentAuthor();
        if ($author->getId()) {
            return __("Edit Author '%1'", $this->escapeHtml($author->getName()));
        }

        return __('New Author');
    }

    /**
     * @return Author
     */
    public function getCurrentAuthor()
    {
        return $this->coreRegistry->registry('borntechies_blog_author');
    }
}
