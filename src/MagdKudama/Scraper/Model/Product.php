<?php

namespace MagdKudama\Scraper\Model;

class Product implements \JsonSerializable {

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var float
     */
    private $unitPrice;

    /**
     * @var string
     */
    private $size;

    /**
     * @param string $title
     * @param string $description
     * @param float $unitPrice
     * @param string $size
     */
    public function __construct(
        $title,
        $description,
        $unitPrice,
        $size
    )
    {
        $this->title = $title;
        $this->description = $description;
        $this->unitPrice = $unitPrice;
        $this->size = $size;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @return float
     */
    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

    public function jsonSerialize()
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'size' => $this->size,
            'unit_price' => $this->unitPrice
        ];
    }
}
