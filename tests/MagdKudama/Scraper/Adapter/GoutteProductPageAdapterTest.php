<?php

namespace MagdKudama\Scraper\Adapter;

use Goutte\Client;
use MagdKudama\Scraper\Adapter\Exception\ScrapingException;
use MagdKudama\Scraper\Model\Product;
use MagdKudama\Scraper\Model\Products;
use MagdKudama\Scraper\Service\DefaultProductNormalizer;
use Symfony\Component\DomCrawler\Crawler;

class GoutteProductPageAdapterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testPageRequest($input, $numberOfProducts, $expected)
    {
        $crawler = new Crawler(null, '');
        $crawler->addContent(file_get_contents($input), 'text/html');

        $goutteMock = \Mockery::mock('Goutte\Client');
        $goutteMock
            ->shouldReceive('request')
            ->with('GET', 'test')
            ->andReturn($crawler);

        $streamMock = \Mockery::mock('GuzzleHttp\Stream\Stream');
        $streamMock
            ->shouldReceive('getSize')
            ->andReturn(100);

        $streamMock
            ->shouldReceive('close')
            ->andReturnNull();

        $responseMock = \Mockery::mock('Symfony\Component\BrowserKit\Response');
        $responseMock
            ->shouldReceive('getContent')
            ->andReturn($streamMock);

        $goutteMock
            ->shouldReceive('getResponse')
            ->andReturn($responseMock);

        for ($i = 1; $i <= $numberOfProducts; $i++) {
            $crawler = new Crawler(null, '');
            $crawler->addContent(file_get_contents(__DIR__ . '/fixtures/products/P' . $i . '.html'), 'text/html');

            $goutteMock
                ->shouldReceive('request')
                ->with('GET', 'P' . $i)
                ->andReturn($crawler);
        }

        $adapter = new GoutteProductPageAdapter($goutteMock, new DefaultProductNormalizer());
        $results = $adapter->getProductsForUrl('test');

        $this->assertEquals($numberOfProducts, count($results->getResults()));
        $this->assertEquals(json_encode($results), json_encode($expected));
    }

    /**
     * @expectedException MagdKudama\Scraper\Adapter\Exception\ScrapingException
     */
    public function testExceptionIsThrownWithInvalidUrl()
    {
        $adapter = new GoutteProductPageAdapter(new Client(), new DefaultProductNormalizer());
        $adapter->getProductsForUrl('malformed');
    }

    public function dataProvider()
    {
        $product1 = new Product(
            'Product1',
            'P1 Description',
            3.5,
            '100B'
        );

        $product2 = new Product(
            'Product2',
            'P2 Description',
            3,
            '100B'
        );

        $two = new Products();
        $two->addResult($product1);
        $two->addResult($product2);

        $one = new Products();
        $one->addResult($product1);

        $none = new Products();

        return [
            [__DIR__ . '/fixtures/two_products.html', 2, $two],
            [__DIR__ . '/fixtures/one_product.html', 1, $one],
            [__DIR__ . '/fixtures/no_products.html', 0, $none]
        ];
    }
}
