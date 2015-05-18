<?php

namespace MagdKudama\Scraper\Service;

use MagdKudama\Scraper\Model\Product;

class DefaultProductNormalizerTest extends \PHPUnit_Framework_TestCase
{
    public function testInputIsNormalized()
    {
        $product = new Product(
            'P1     ',
            '',
            'unit price  123.99$$$$',
            '1230'
        );

        $expected = new Product(
            'P1',
            '',
            123.99,
            '1.23kB'
        );

        $normalizer = new DefaultProductNormalizer();
        $newProduct = $normalizer->normalize($product);

        $this->assertEquals(json_encode($expected), json_encode($newProduct));
    }
}
