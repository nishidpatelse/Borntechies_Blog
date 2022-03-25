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

namespace Borntechies\Blog\Block\Tag;

use Borntechies\Blog\Helper\Data;
use Borntechies\Blog\Model\ResourceModel\Post\Collection;
use Borntechies\Blog\Model\TagFactory;

/**
 * Class Listpost
 * @package Borntechies\Blog\Block\Tag
 */
class Listpost extends \Borntechies\Blog\Block\Listpost
{
    /**
     * @var TagFactory
     */
    protected $_tag;

    /**
     * Override this function to apply collection for each type
     *
     * @return Collection
     */
    protected function getCollection()
    {
        if ($tag = $this->getBlogObject()) {
            return $this->helperData->getPostCollection(Data::TYPE_TAG, $tag->getId());
        }

        return null;
    }

    /**
     * @return mixed
     */
    protected function getBlogObject()
    {
        if (!$this->_tag) {
            $id = $this->getRequest()->getParam('id');

            if ($id) {
                $tag = $this->helperData->getObjectByParam($id, null, Data::TYPE_TAG);
                if ($tag && $tag->getId()) {
                    $this->_tag = $tag;
                }
            }
        }

        return $this->_tag;
    }

    /**
     * @inheritdoc
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        if ($breadcrumbs = $this->getLayout()->getBlock('breadcrumbs')) {
            $tag = $this->getBlogObject();
            if ($tag) {
                $breadcrumbs->addCrumb($tag->getUrlKey(), [
                    'label' => __('Tag'),
                    'title' => __('Tag')
                ]);
            }
        }
    }

    /**
     * @param bool $meta
     *
     * @return array
     */
    public function getBlogTitle($meta = false)
    {
        $blogTitle = parent::getBlogTitle($meta);
        $tag = $this->getBlogObject();
        if (!$tag) {
            return $blogTitle;
        }

        if ($meta) {
            if ($tag->getMetaTitle()) {
                array_push($blogTitle, $tag->getMetaTitle());
            } else {
                array_push($blogTitle, ucfirst($tag->getName()));
            }

            return $blogTitle;
        }

        return ucfirst($tag->getName());
    }
}
