<?php

namespace MagdKudama\Scraper\Model;

class Products implements \JsonSerializable {

    /**
     * @var Product[]
     */
    private $results = [];

    /**
     * @param Product $product
     */
    public function addResult(Product $product)
    {
        $this->results[] = $product;
    }

    /**
     * @return Product[]
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @return float
     */
    public function getTotal()
    {
        return $this->calculateTotal();
    }

    /**
     * @return float
     */
    protected function calculateTotal()
    {
        $total = 0;

        foreach ($this->results as $result) {
            $total += $result->getUnitPrice();
        }

        return $total;
    }

    public function jsonSerialize()
    {
        return [
            'results' => $this->results,
            'total' => $this->calculateTotal()
        ];
    }
}
