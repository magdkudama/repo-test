<?php

namespace MagdKudama\Scraper\Command;

use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;
use MagdKudama\Scraper\Adapter\GoutteProductPageAdapter;
use MagdKudama\Scraper\Service\DefaultProductNormalizer;
use MagdKudama\Scraper\ProductPageScraper;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ScrapCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('test:scrap')
            ->setDescription("Scraps the Sainsbury's product page and returns some useful data");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Process started...');

        $productsPageAdapter = new GoutteProductPageAdapter(new Client(), new DefaultProductNormalizer(new GuzzleClient()));
        $scrapService = new ProductPageScraper($productsPageAdapter);

        $url = 'http://www.sainsburys.co.uk/webapp/wcs/stores/servlet/CategoryDisplay';
        $url .= '?listView=true';
        $url .= '&orderBy=FAVOURITES_FIRST';
        $url .= '&parent_category_rn=12518';
        $url .= '&top_category=12518';
        $url .= '&langId=44';
        $url .= '&beginIndex=0';
        $url .= '&pageSize=20';
        $url .= '&catalogId=10137';
        $url .= '&searchTerm=&categoryId=185749';
        $url .= '&listId=&storeId=10151';
        $url .= '&promotionId=#langId=44&storeId=10151';
        $url .= '&catalogId=10137&categoryId=185749';
        $url .= '&parent_category_rn=12518';
        $url .= '&top_category=12518';
        $url .= '&pageSize=20';
        $url .= '&orderBy=FAVOURITES_FIRST';
        $url .= '&searchTerm=&beginIndex=0&hideFilters=true';

        try {
            $results = $scrapService->getResultsFor($url);
            $output->writeln(json_encode($results, \JSON_PRETTY_PRINT));
        } catch (\Exception $e) {
            $output->writeln('<error>Please try again later: ' . $e->getMessage() . '</error>');
        }

        $output->writeln('Process ended...');
    }
}
