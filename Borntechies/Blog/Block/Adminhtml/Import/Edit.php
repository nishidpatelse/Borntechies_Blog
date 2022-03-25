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

namespace Borntechies\Blog\Block\Adminhtml\Import;

use Magento\Backend\Block\Widget\Form\Container;
use Magento\Framework\Phrase;

/**
 * Class Edit
 * @package Borntechies\Blog\Block\Adminhtml\Import
 */
class Edit extends Container
{
    /**
     * Internal constructor
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();

        $this->buttonList->remove('back');
        $this->buttonList->remove('reset');
        $this->buttonList->remove('save');

        $this->buttonList->add(
            'check-connection',
            [
                'label' => __('Check Connection'),
                'class' => 'primary',
                'data_attribute' => [
                    'mage-init' => [
                        'button' => [
                            'target' => '#edit_form',

                        ]
                    ]
                ],
                'onclick' => 'blogImport.initImportCheckConnection();'
            ],
            -100
        );
        $this->_objectId = 'import_id';
        $this->_blockGroup = 'Borntechies_Blog';
        $this->_controller = 'adminhtml_import';
    }

    /**
     * Get header text
     *
     * @return Phrase
     */
    public function getHeaderText()
    {
        return __('Import Setting');
    }
}
