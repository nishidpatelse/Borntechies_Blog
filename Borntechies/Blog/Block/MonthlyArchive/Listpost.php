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

namespace Borntechies\Blog\Block\MonthlyArchive;

use Borntechies\Blog\Helper\Data;
use Borntechies\Blog\Model\ResourceModel\Post\Collection;

/**
 * Class Listpost
 * @package Borntechies\Blog\Block\MonthlyArchive
 */
class Listpost extends \Borntechies\Blog\Block\Listpost
{
    /**
     * Override this function to apply collection for each type
     *
     * @return Collection
     */
    protected function getCollection()
    {
        return $this->helperData->getPostCollection(Data::TYPE_MONTHLY, $this->getMonthKey());
    }

    /**
     * @return mixed
     */
    protected function getMonthKey()
    {
        return $this->getRequest()->getParam('month_key');
    }

    /**
     * @return false|string
     */
    protected function getMonthLabel()
    {
        return $this->helperData->getDateFormat($this->getMonthKey() . '-10', true);
    }

    /**
     * @inheritdoc
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        if ($breadcrumbs = $this->getLayout()->getBlock('breadcrumbs')) {
            $breadcrumbs->addCrumb($this->getMonthKey(), [
                'label' => __('Monthy Archive'),
                'title' => __('Monthy Archive')
            ]);
        }
    }

    /**
     * @param bool $meta
     *
     * @return array|false|string
     */
    public function getBlogTitle($meta = false)
    {
        $blogTitle = parent::getBlogTitle($meta);

        if ($meta) {
            array_push($blogTitle, $this->getMonthLabel());

            return $blogTitle;
        }

        return $this->getMonthLabel();
    }
}
