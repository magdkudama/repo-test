<?php

namespace MagdKudama\Scraper;

use MagdKudama\Scraper\Adapter\ProductPageAdapter;
use MagdKudama\Scraper\Model\Products;

class ProductPageScraper
{
    /**
     * @var ProductPageAdapter
     */
    private $adapter;

    /**
     * @param ProductPageAdapter $adapter
     */
    public function __construct(ProductPageAdapter $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @param string $url
     * @return Products
     */
    public function getResultsFor($url)
    {
        return $this->adapter->getProductsForUrl($url);
    }
}
