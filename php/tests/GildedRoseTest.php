<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function testAgedBrieIncrementsInQuality()
    {
        $items = [new Item("Aged Brie", 10, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertEquals(21, $items[0]->quality);
        $this->assertEquals(9, $items[0]->sellIn);
    }

    public function testBackstagePassesIncrementInQualityTwice()
    {
        $items = [new Item("Backstage passes to a TAFKAL80ETC concert", 10, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertEquals(22, $items[0]->quality);
        $this->assertEquals(9, $items[0]->sellIn);
    }

    public function testBackstagePassesIncrementInQualityThrice()
    {
        $items = [new Item("Backstage passes to a TAFKAL80ETC concert", 5, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertEquals(23, $items[0]->quality);
        $this->assertEquals(4, $items[0]->sellIn);
    }

    public function testBackstagePassesDropToZeroAfterConcert()
    {
        $items = [new Item("Backstage passes to a TAFKAL80ETC concert", 0, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertEquals(0, $items[0]->quality);
        $this->assertEquals(-1, $items[0]->sellIn);
    }

    public function testConjuredQualityDecrementsTwiceAsFast()
    {
        $items = [new Item("Conjured Mana Cake", 10, 20)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertEquals(18, $items[0]->quality);
        $this->assertEquals(9, $items[0]->sellIn);
    }

    public function testSulfurasDoesNotChange()
    {
        $items = [new Item("Sulfuras, Hand of Ragnaros", 0, 80)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertEquals(80, $items[0]->quality);
        $this->assertEquals(0, $items[0]->sellIn);
    }

    public function testDefaultItemDecrementsInQuality()
    {
        $items = [new Item("Default Item", 5, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertEquals(9, $items[0]->quality);
        $this->assertEquals(4, $items[0]->sellIn);
    }

    public function testDefaultItemQualityDegradesTwiceAsFastAfterSellIn()
    {
        $items = [new Item("Default Item", -1, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertEquals(8, $items[0]->quality);
        $this->assertEquals(-2, $items[0]->sellIn);
    }
}
