<?php

namespace Gene\BlueFoot\Model\Attribute\Data\Widget;

use Magento\Catalog\Api\ProductRepositoryInterface;

/**
 * Class Category
 *
 * @package Gene\BlueFoot\Model\Attribute\Data\Widget
 *
 * @author Hob Adams <hob@gene.co.uk>
 */
class Category extends \Gene\BlueFoot\Model\Attribute\Data\AbstractWidget implements \Gene\BlueFoot\Model\Attribute\Data\WidgetInterface
{

    /**
     * @var ProductRepositoryInterface
     */
    protected $_productRepository;

    /**
     * @var \Magento\Catalog\Model\CategoryFactory
     */
    protected $categoryFactory;

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param ProductRepositoryInterface $productRepositoryInterface
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource|null $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb|null $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        ProductRepositoryInterface $productRepositoryInterface,
        \Magento\Catalog\Model\CategoryFactory $categoryFactory,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection);
        $this->_productRepository = $productRepositoryInterface;
        $this->_categoryFactory = $categoryFactory;
    }


    /**
     * Load a category based
     * @return $this|bool
     */
    public function getCategory()
    {
        if ($categoryId = $this->getEntity()->getData($this->getAttribute()->getData('attribute_code'))) {
            $category = $this->_categoryFactory->create()->load($categoryId);
            return $category;
        }
        return false;
    }

    /**
     * @return bool|\Magento\Catalog\Model\CategoryFactory
     */
    public function getProductCollection()
    {
        if ($this->getCategory()) {
            return $this->getCategory()->getProductCollection()->addAttributeToSelect('*');
        }
        return false;
        //$pageSize = ($this->getEntity()->getProductCount()) ? $this->getEntity()->getProductCount() : 4 ;
        // $this->getEntity()->getHideOutOfStock()
         //->getProductCollection()->addAttributeToSelect('*');
    }


    /**
     * Return an array of basic product data used by the page builder
     *
     * @return array
     */
    /*public function asJson()
    {
        $return = array();

        // Add category name if it's present
        $categoryId = $this->getEntity()->getData($this->getAttribute()->getData('attribute_code'));
        if( $categoryId ) {
            $category = Mage::getModel('catalog/category')->load($categoryId);
            $return['category'] = array("name" => $category->getName());
        }

        // Load products for the category
        $collection = $this->getProductCollection();
        if(!$collection) {
            return $return;
        }

        foreach($collection as $product) {
            $return['products'][] = array(
                'name' => $product->getName(),
                'sku' => $product->getSku(),
                //'image' => $this->_getProductImage($product),
                //'price' => Mage::helper('core')->currency($product->getFinalPrice(), true, false)
            );
        }

        return $return;
    }*/

    /**
     * Return the url of the product image
     *
     * @param $product
     * @return string
     */
    /*protected function _getProductImage($product)
    {

        try{
            $imgSrc = (string) Mage::helper('catalog/image')->init($product, 'small_image')->resize(200);
        }
        catch(Exception $e) {
            $imgSrc = Mage::getDesign()->getSkinUrl('images/catalog/product/placeholder/image.jpg',array('_area'=>'frontend'));
        }

        return $imgSrc;
    }*/

}