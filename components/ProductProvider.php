<?php
/**
 * Component find products, divide them to parted display and provide all necessary data.
 * May content more complicated filter conditions.
 *
 * We implements parted data fetching without standard SQL OFFSET.
 * It is much faster on huge amount of data and large offsets.
 *
 * @property array $data Products, according to current offset and limit
 * @property bool $isFinished Are there some data after already provided
 * @property int $nextOffset Identifier to describe offset for providing next portion of data
 */
class ProductProvider extends CComponent
{
    private $_isFinished;
    private $_nextOffset;
    private $_data;

    /**
     * @param int $offset Special identifier to describe offset of providing data
     * @param int $limit How much products should be provided
     */
    public function __construct($offset = 0, $limit = 10)
    {
        // Fetching data after ID = $offset
        $data = Product::model()->basicData($offset, $limit);

        // If number of fetched products less than $limit, then this is last portion of data
        if (count($data) < $limit) {
            $this->_nextOffset = null;
            $this->_isFinished = true;
        } else {
            $lastProduct = end($data);
            $this->_nextOffset = $lastProduct['id'] + 1;
            $this->_isFinished = false;
        }

        $this->_data = $data;
    }

    /**
     * @return array Returns products, according to current offset and limit
     */
    public function getData()
    {
        return $this->_data;
    }

    /**
     * @return bool Are there some data after already provided
     */
    public function getIsFinished()
    {
        return $this->_isFinished;
    }

    /**
     * Generates identifier to describe offset for providing next portion of data.
     * If there are no data after already provided, returns null
     * @return int|null
     */
    public function getNextOffset()
    {
        return $this->_nextOffset;
    }
}
