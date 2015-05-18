<?php

namespace MagdKudama\Scraper\Service;

use MagdKudama\Scraper\Model\Product;

interface ProductNormalizer
{
    /**
     * @param Product $product
     * @return Product
     */
    function normalize(Product $product);
}
