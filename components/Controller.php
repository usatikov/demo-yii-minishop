<?php
/**
 * Customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = [];

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = [];

    /**
     * Generates URL of product's image
     * This is to prevent direct calls of ImageManager from views and models.
     * So, only controller knows, witch component process images.
     * @param int $productId ID of product
     * @return string Generated URL
     */
    public function imageUrl($productId)
    {
        return Yii::app()->images->url($productId);
    }
}
