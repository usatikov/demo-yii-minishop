<?php
/**
 * Component to process images for products.
 *
 * Under high load you may use more complicated way to store images.
 * To generate filename for image you should use random string instead of just "$id.jpg".
 * Then you will be able to leave old images after updating (to avoid HDD segmentation)
 * and to make new name for new product's picture.
 * Generating new name for picture after updating is necessary to avoid user's browser cache.
 */
class ImageManager extends CApplicationComponent
{
    /**
     * @var string Alias of root directory, where images will be saved
     */
    public $storageAlias = 'application.www.images.uploads';

    /**
     * @var int Number of subdirectories to store images.
     * This is to prevent filesystem problems, when huge amount of uploaded files are storing in one directory.
     */
    public $factor = 10;

    /**
     * @var string URL of root directory (see storageAlias) to access via HTTP
     */
    public $baseUrl = '/images/uploads';

    /**
     * Saves uploaded image for this product
     * @param int $id ID of product
     * @param CUploadedFile $file Uploaded image file
     */
    public function save($id, CUploadedFile $file)
    {
        $path = $this->path($id);

        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $file->saveAs($path . $this->fileName($id));
    }

    /**
     * Deletes image of this product
     * @param int $id ID of product
     */
    public function delete($id)
    {
        $filename = $this->path($id) . $this->fileName($id);

        if (file_exists($filename)) {
            unlink($filename);
        }
    }

    /**
     * Returns URL of this product's image to access via HTTP
     * @param int $id ID of product
     * @return string
     */
    public function url($id)
    {
        return $this->baseUrl . $this->dirName($id) . $this->filename($id);
    }

    /**
     * Returns name of subdirectory, where product's image should be stored
     * @param int $id ID of product
     * @return string
     */
    private function dirName($id)
    {
        $name = $id % $this->factor;

        return "/$name";
    }

    /**
     * Returns full path of directory, where product's image should be stored
     * @param int $id ID of product
     * @return string
     */
    private function path($id)
    {
        return Yii::getPathOfAlias($this->storageAlias) . $this->dirName($id);
    }

    /**
     * Returns filename of product's image (relative to subdirectory)
     * @param int $id ID of product
     * @return string
     */
    private function fileName($id)
    {
        return "/$id.jpg";
    }
}
