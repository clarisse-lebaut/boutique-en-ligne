<?php
use PHPUnit\Framework\TestCase;

require_once 'candy_class.php';

class CandyTest extends TestCase {

    protected $candy;

    protected function setUp(): void {
        $this->candy = new candy();
    }

    public function testGetCandyById() {
        $candy_id = 1;
        $candy = $this->candy->getcandyById($candy_id);
        $this->assertNotEmpty($candy);
        $this->assertArrayHasKey('name', $candy);
    }

    public function testGetPaginatedCandy() {
        $page = 1;
        $candys_per_page = 5;
        $candys = $this->candy->getPaginatedCandy($page, $candys_per_page);
        $this->assertCount($candys_per_page, $candys);
    }

    public function testGetTotalCandyCount() {
        $total_candys = $this->candy->getTotalCandyCount();
        $this->assertGreaterThan(0, $total_candys);
    }

    public function testGetPaginatedCandyWithFiltersAndSort() {
        $page = 1;
        $candys_per_page = 5;
        $category = "Chocolate";
        $min_price = 1;
        $max_price = 10;
        $sort_by = "price";
        $order = "desc";
        $candys = $this->candy->getPaginatedCandy($page, $candys_per_page, $category, $min_price, $max_price, $sort_by, $order);
        $this->assertNotEmpty($candys);
    }

    public function testGetTotalCandyCountWithFilters() {
        $category = "Chocolate";
        $min_price = 1;
        $max_price = 10;
        $total_candys = $this->candy->getTotalCandyCount($category, $min_price, $max_price);
        $this->assertGreaterThan(0, $total_candys);
    }

    public function testGetCandiesByIds() {
        $ids = [1, 2, 3];
        $candies = $this->candy->getCandiesByIds($ids);
        $this->assertCount(3, $candies);
    }
}
?>
