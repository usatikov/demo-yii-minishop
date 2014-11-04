<?php
/**
 * Unit test for product's model
 */
class ProductTest extends DbTestCase
{
    /** @var array A list of fixtures that should be loaded before each test method executes */
    protected $fixtures = ['Product'];

    /**
     * Test fetching basic info about products
     */
    public function testBasicData()
    {
        $data = Product::model()->basicData();
        $this->assertCount(7, $data);

        $last = end($data);
        $this->assertEquals([
            'id' => 76,
            'name' => 'The Last Product',
            'price' => 120,
        ], $last);

        $data = Product::model()->basicData(5, 3);
        $this->assertCount(3, $data);
        $this->assertEquals([
            'id' => 5,
            'name' => 'Five',
            'price' => 40012.10,
        ], $data[0]);

        $data = Product::model()->basicData(500, 10);
        $this->assertCount(0, $data);
    }

    /**
     * Test fetching basic info about one product
     * @dataProvider oneBasicDataProvider
     * @param int $id ID of a product to be fetched
     * @param string $name Expected name of the product
     * @param double $price Expected price of the product
     */
    public function testOneBasicData($id, $name, $price)
    {
        $data = Product::model()->oneBasicData($id);

        $this->assertArrayHasKey('id', $data);
        $this->assertEquals($id, $data['id']);

        $this->assertArrayHasKey('name', $data);
        $this->assertEquals($name, $data['name']);

        $this->assertArrayHasKey('price', $data);
        $this->assertEquals($price, $data['price']);
    }

    /**
     * @return array Data to test fetching basic info about one product
     */
    public function oneBasicDataProvider()
    {
        return [
            [2, 'The Second Product', 457.30],
            [76, 'The Last Product', 120],
            [12, 'Twelve', 300],
        ];
    }

    /**
     * Test fetching basic info about one product with wrong IDs
     */
    public function testWrongOneBasicData()
    {
        $data = Product::model()->oneBasicData(100500);
        $this->assertEquals(false, $data);

        $data = Product::model()->oneBasicData('bla-bla-bla');
        $this->assertEquals(false, $data);
    }
}
