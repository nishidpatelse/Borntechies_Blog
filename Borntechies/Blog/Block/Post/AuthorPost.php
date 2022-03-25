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

namespace Borntechies\Blog\Block\Post;

use Exception;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magento\Framework\UrlInterface;
use Magento\Theme\Block\Html\Pager;
use Borntechies\Blog\Helper\Data;
use Borntechies\Blog\Model\Post;
use Borntechies\Blog\Model\ResourceModel\Post\Collection;

/**
 * Class AuthorPost
 * @package Borntechies\Blog\Block\Post
 */
class AuthorPost extends \Borntechies\Blog\Block\Listpost
{
    /**
     * @return AbstractCollection|Collection|null
     */
    public function getPostCollection()
    {
        try {
            $collection = $this->helperData->getFactoryByType()->create()->getCollection();
            $this->helperData->addStoreFilter($collection, $this->store->getStore()->getId());

            $userId = $this->getAuthor()->getId();

            $collection->addFieldToFilter('author_id', $userId);

            if ($collection && $collection->getSize()) {
                $pager         = $this->getLayout()->createBlock(Pager::class, 'blog.post.pager');
                $perPageValues = (string) $this->helperData->getConfigGeneral('pagination');
                $perPageValues = explode(',', $perPageValues);
                $perPageValues = array_combine($perPageValues, $perPageValues);

                $pager->setAvailableLimit($perPageValues)->setCollection($collection);
                $this->setChild('pager', $pager);
            }
        } catch (Exception $e) {
            $collection = null;
        }

        return $collection;
    }

    /**
     * @param string $statusId
     *
     * @return mixed
     */
    public function getStatusHtmlById($statusId)
    {
        $statusText = $this->authorStatusType->toArray()[$statusId]->getText();

        switch ($statusId) {
            case '2':
                $html = '<div class="mp-post-status mp-post-disapproved">' . __($statusText) . '</div>';
                break;
            case '1':
                $html = '<div class="mp-post-status mp-post-approved">' . __($statusText) . '</div>';
                break;
            case '0':
            default:
                $html = '<div class="mp-post-status mp-post-pending">' . __($statusText) . '</div>';
                break;
        }

        return $html;
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        $array = explode('/', $this->helperData->getConfigValue('cms/wysiwyg/editor'));
        if ($array[count($array) - 1] === 'tinymce4Adapter') {
            return 4;
        }

        return 3;
    }

    /**
     * @return int
     */
    public function getMagentoVersion()
    {
        return (int) $this->helperData->versionCompare('2.3.0') ? 3 : 2;
    }

    /**
     * @param AbstractCollection|Collection|null $postCollection
     *
     * @return string
     */
    public function getPostDatas($postCollection)
    {
        $result = [];

        if ($postCollection) {
            try {
                /** @var Post $post */
                foreach ($postCollection->getItems() as $post) {
                    $post->getCategoryIds();
                    $post->getTopicIds();
                    $post->getTagIds();
                    if ($post->getPostContent()) {
                        $post->setData('post_content', $this->getPageFilter($post->getPostContent()));
                    }
                    $result[$post->getId()] = $post->getData();
                }
            } catch (Exception $e) {
                $result = [];
            }
        }

        return Data::jsonEncode($result);
    }

    /**
     * @return mixed
     */
    public function getAuthorName()
    {
        return $this->getAuthor()->getName();
    }

    /**
     * @return bool
     */
    public function getAuthorStatus()
    {
        $author = $this->getAuthor();

        return $author->getStatus() === '1';
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->coreRegistry->registry('mp_author');
    }

    /**
     * @param bool $meta
     *
     * @return array
     */
    public function getBlogTitle($meta = false)
    {
        return $meta ? [$this->getAuthor()->getName()] : $this->getAuthor()->getName();
    }

    /**
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getBaseMediaUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
    }
}
