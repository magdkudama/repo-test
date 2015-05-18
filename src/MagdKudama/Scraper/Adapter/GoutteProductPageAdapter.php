<?php

namespace MagdKudama\Scraper\Adapter;

use Goutte\Client;
use MagdKudama\Scraper\Adapter\Exception\ScrapingException;
use MagdKudama\Scraper\Model\Product;
use MagdKudama\Scraper\Model\Products;
use MagdKudama\Scraper\Service\ProductNormalizer;

class GoutteProductPageAdapter implements ProductPageAdapter
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var ProductNormalizer
     */
    private $normalizer;

    /**
     * @param Client $client
     * @param ProductNormalizer $normalizer
     */
    public function __construct(
        Client $client,
        ProductNormalizer $normalizer = null
    )
    {
        $this->client = $client;
        $this->normalizer = $normalizer;
    }

    /**
     * @param string $url
     * @return Products
     * @throws ScrapingException
     */
    public function getProductsForUrl($url)
    {
        $products = new Products();

        try {
            $crawler = $this->client->request('GET', $url);

            $crawler->filter('#productsContainer .productLister li')->each(function ($node) use (&$products) {
                $titleNode = $node->filter('.product .productInfoWrapper h3 > a')->getNode(0);
                $title = $titleNode->nodeValue;
                $unitPrice = $node->filter('.product .pricingAndTrolleyOptions .pricePerUnit')->getNode(0)->nodeValue;

                $productUrl = $titleNode->getAttribute('href');
                $specificPageCrawler = $this->client->request('GET', $productUrl);

                $descriptionNode = $specificPageCrawler->filter('#information div.productText')->getNode(0);

                $description = '';
                if ($descriptionNode) {
                    $description = $descriptionNode->nodeValue;
                }

                $product = new Product(
                    $title,
                    $description,
                    $unitPrice,
                    $this->client->getResponse()->getContent()->getSize()
                );

                if ($this->normalizer) {
                    $product = $this->normalizer->normalize($product);
                }

                $products->addResult($product);
            });
        } catch (\Exception $e) {
            throw new ScrapingException($e->getMessage());
        }

        return $products;
    }
}
