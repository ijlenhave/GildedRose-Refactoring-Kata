<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    /**
     * @param Item[] $items
     */
    public function __construct(
        private array $items
    ) {
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            switch ($item->name) {
                case 'Aged Brie':
                    $this->updateAgedBrie($item);
                    break;

                case 'Backstage passes to a TAFKAL80ETC concert':
                    $this->updateBackstagePasses($item);
                    break;

                case 'Conjured Mana Cake':
                    $this->updateConjured($item);
                    break;

                case 'Sulfuras, Hand of Ragnaros':
                    break;

                default:
                    $this->updateDefault($item);
                    break;
            }
        }
    }

    /**
     * @param Item $item
     */
    private function updateAgedBrie(Item $item): void
    {
        $this->incrementQuality($item);
        $item->sellIn--;
    }
    
    /**
     * @param Item $item
     */
    private function updateBackstagePasses(Item $item): void
    {
        $this->incrementQuality($item);

        if ($item->sellIn < 11) {
            $this->incrementQuality($item);
        }

        if ($item->sellIn < 6) {
            $this->incrementQuality($item);
        }

        $item->sellIn--;

        if ($item->sellIn < 0) {
            $item->quality = 0;
        }
    }

    /**
     * @param Item $item
     */
    private function updateDefault(Item $item): void
    {
        $this->decrementQuality($item);
        $item->sellIn--;

        if ($item->sellIn < 0) {
            $this->decrementQuality($item);
        }
    }

    /**
     * @param Item $item
     */
    private function updateConjured(Item $item): void
    {
        $this->decrementQuality($item);
        $this->decrementQuality($item);
        $item->sellIn--;
    }

    /**
     * @param Item $item
     */
    private function incrementQuality(Item $item): void
    {
        if ($item->quality < 50) {
            $item->quality++;
        }
    }

    /**
     * @param Item $item
     */
    private function decrementQuality(Item $item): void
    {
        if ($item->quality > 0) {
            $item->quality--;
        }
    }
}
