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

namespace Borntechies\Blog\Model\ResourceModel;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Borntechies\Blog\Helper\Data;

/**
 * Class PostLike
 * @package Borntechies\Blog\Model\ResourceModel
 */
class PostHistory extends AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('borntechies_blog_post_history', 'history_id');
    }

    /**
     * @param AbstractModel $object
     *
     * @return AbstractDb
     */
    protected function _beforeSave(AbstractModel $object)
    {
        if (is_array($object->getData('store_ids'))) {
            $object->setData('store_ids', implode(',', $object->getData('store_ids')));
        }
        if (is_array($object->getData('categories_ids'))) {
            $object->setData('category_ids', implode(',', $object->getData('categories_ids')));
        }
        if (is_array($object->getData('topics_ids'))) {
            $object->setData('topic_ids', implode(',', $object->getData('topics_ids')));
        }
        if (is_array($object->getData('tags_ids'))) {
            $object->setData('tag_ids', implode(',', $object->getData('tags_ids')));
        }
        if (is_array($object->getData('products_data'))) {
            $data = $object->getData('products_data');
            foreach ($data as $key => $datum) {
                $data[$key]['position'] = $datum['position'] ?: '0';
            }

            $object->setData('product_ids', Data::jsonEncode($data));
        }

        return parent::_beforeSave($object);
    }

    protected function _afterLoad(AbstractModel $object)
    {
        $object->setData('categories_ids', explode(',', $object->getCategoryIds()));
        $object->setData('tags_ids', explode(',', $object->getTagIds()));
        $object->setData('topics_ids', explode(',', $object->getTopicIds()));

        return parent::_afterLoad($object);
    }
}
