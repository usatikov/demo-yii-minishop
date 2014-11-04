<?php
/**
 * @var $this SiteController
 * @var $product Product
 */

Yii::app()->clientScript->registerCssFile('/css/products.css');

?>

<div class="product-details">
    <div class="image"><img src="<?= CHtml::encode($this->imageUrl($product['id'])) ?>" alt="" /></div>
    <div class="name"><?= CHtml::encode($product['name']) ?></div>
    <div class="price"><?= Yii::app()->numberFormatter->formatCurrency($product['price'], '&#8364;') ?></div>
    <div class="description"><?= nl2br(CHtml::encode($product['description'])) ?></div>
</div>
