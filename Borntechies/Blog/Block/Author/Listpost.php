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

namespace Borntechies\Blog\Block\Author;

use Borntechies\Blog\Helper\Data;
use Borntechies\Blog\Model\AuthorFactory;
use Borntechies\Blog\Model\ResourceModel\Post\Collection;

/**
 * Class Listpost
 * @package Borntechies\Blog\Block\Author
 */
class Listpost extends \Borntechies\Blog\Block\Listpost
{
    /**
     * @var AuthorFactory
     */
    protected $_author;

    /**
     * Override this function to apply collection for each type
     *
     * @return Collection
     */
    protected function getCollection()
    {
        if ($author = $this->getAuthor()) {
            return $this->helperData->getPostCollection(Data::TYPE_AUTHOR, $author->getId());
        }

        return null;
    }

    /**
     * @return mixed
     */
    protected function getAuthor()
    {
        if (!$this->_author) {
            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $author = $this->helperData->getObjectByParam($id, null, Data::TYPE_AUTHOR);
                if ($author && $author->getId()) {
                    $this->_author = $author;
                }
            }
        }

        return $this->_author;
    }

    /**
     * @inheritdoc
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        if ($breadcrumbs = $this->getLayout()->getBlock('breadcrumbs')) {
            $author = $this->getAuthor();
            if ($author) {
                $breadcrumbs->addCrumb($author->getUrlKey(), [
                    'label' => __('Author'),
                    'title' => __('Author')
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
        $author = $this->getAuthor();
        if (!$author) {
            return $blogTitle;
        }

        if ($meta) {
            array_push($blogTitle, ucfirst($author->getName()));

            return $blogTitle;
        }

        return ucfirst($author->getName());
    }
}
