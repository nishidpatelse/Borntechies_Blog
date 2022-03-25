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

namespace Borntechies\Blog\Model\Config\Source;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magento\Framework\Option\ArrayInterface;
use Borntechies\Blog\Model\AuthorFactory;

/**
 * Class Author
 * @package Borntechies\Faqs\Model\Config\Source
 */
class Author implements ArrayInterface
{
    /**
     * @var AuthorFactory
     */
    public $_authorFactory;

    public function __construct(
        AuthorFactory $authorFactory
    ) {
        $this->_authorFactory = $authorFactory;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options = [];
        foreach ($this->getAuthors() as $value => $author) {
            $options[] = [
                'value' => $value,
                'label' => $author->getName()
            ];
        }

        return $options;
    }

    /**
     * @return AbstractCollection
     */
    public function getAuthors()
    {
        return $this->_authorFactory->create()->getCollection()->addFieldToFilter('status', '1');
    }
}
