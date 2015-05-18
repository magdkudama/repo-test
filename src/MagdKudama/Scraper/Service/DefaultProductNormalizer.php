<?php

namespace MagdKudama\Scraper\Service;

use ByteUnits\Metric;
use GuzzleHttp\Client;
use MagdKudama\Scraper\Model\Product;

class DefaultProductNormalizer implements ProductNormalizer
{
    /**
     * @param Product $product
     * @return Product
     */
    public function normalize(Product $product)
    {
        $unitPrice = preg_replace('/[^0-9.]/', '', $product->getUnitPrice());

        $newProduct = new Product(
            trim($product->getTitle()),
            trim($product->getDescription()),
            (float)$unitPrice,
            Metric::bytes($product->getSize())->format()
        );

        return $newProduct;
    }
}
