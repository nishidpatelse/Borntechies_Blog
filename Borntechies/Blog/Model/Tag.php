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

namespace Borntechies\Blog\Model;

use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;
use Borntechies\Blog\Model\ResourceModel\Post\Collection;
use Borntechies\Blog\Model\ResourceModel\Post\CollectionFactory;
use Borntechies\Blog\Model\ResourceModel\Tag\CollectionFactory as TagCollectionFactory;

/**
 * @method Tag setName($name)
 * @method Tag setDescription($description)
 * @method Tag setEnabled($enabled)
 * @method mixed getName()
 * @method mixed getDescription()
 * @method mixed getEnabled()
 * @method Tag setCreatedAt(string $createdAt)
 * @method string getCreatedAt()
 * @method Tag setUpdatedAt(string $updatedAt)
 * @method string getUpdatedAt()
 * @method Tag setPostsData(array $data)
 * @method array getPostsData()
 * @method Tag setIsChangedPostList(bool $flag)
 * @method bool getIsChangedPostList()
 * @method Tag setAffectedPostIds(array $ids)
 * @method bool getAffectedPostIds()
 */
class Tag extends AbstractModel
{
    /**
     * Cache tag
     *
     * @var string
     */
    const CACHE_TAG = 'borntechies_blog_tag';

    /**
     * Cache tag
     *
     * @var string
     */
    protected $_cacheTag = 'borntechies_blog_tag';

    /**
     * Event prefix
     *
     * @var string
     */
    protected $_eventPrefix = 'borntechies_blog_tag';

    /**
     * Post Collection
     *
     * @var Collection
     */
    public $postCollection;

    /**
     * Post Collection Factory
     *
     * @var CollectionFactory
     */
    public $postCollectionFactory;

    /**
     * @var TagCollectionFactory
     */
    public $tagCollectionFactory;

    /**
     * Tag constructor.
     *
     * @param Context $context
     * @param Registry $registry
     * @param CollectionFactory $postCollectionFactory
     * @param TagCollectionFactory $tagCollectionFactory
     * @param AbstractResource|null $resource
     * @param AbstractDb|null $resourceCollection
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        CollectionFactory $postCollectionFactory,
        TagCollectionFactory $tagCollectionFactory,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        $this->postCollectionFactory = $postCollectionFactory;
        $this->tagCollectionFactory = $tagCollectionFactory;

        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel\Tag::class);
    }

    /**
     * Get identities
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @return array|mixed
     */
    public function getPostsPosition()
    {
        if (!$this->getId()) {
            return [];
        }

        $array = $this->getData('posts_position');
        if (!$array) {
            $array = $this->getResource()->getPostsPosition($this);
            $this->setData('posts_position', $array);
        }

        return $array;
    }

    /**
     * @return Collection
     */
    public function getSelectedPostsCollection()
    {
        if ($this->postCollection === null) {
            $collection = $this->postCollectionFactory->create();
            $collection->join(
                ['post_tag' => $this->getResource()->getTable('borntechies_blog_post_tag')],
                'main_table.post_id=post_tag.post_id AND post_tag.tag_id=' . $this->getId(),
                ['position']
            );

            $this->postCollection = $collection;
        }

        return $this->postCollection;
    }
}
