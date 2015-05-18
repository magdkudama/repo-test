<?php

namespace MagdKudama\Scraper\Adapter;

use MagdKudama\Scraper\Adapter\Exception\ScrapingException;
use MagdKudama\Scraper\Model\Products;

interface ProductPageAdapter
{
    /**
     * @param string $url
     * @return Products
     * @throws ScrapingException
     */
    function getProductsForUrl($url);
}
