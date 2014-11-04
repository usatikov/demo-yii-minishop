<?php
/**
 * @var $this SiteController
 * @var $dataProvider ProductProvider
 */

// Some solution to join and compress assets is required under high load.
Yii::app()->clientScript
    ->registerPackage('jquery')
    ->registerCssFile('/css/colorbox.css')
    ->registerScriptFile('/js/jquery.colorbox.js')
    ->registerScriptFile('/js/jquery.lazyload.js')
    ->registerScriptFile('/js/jquery.jscroll.js')
    ->registerCssFile('/css/products.css')
    ->registerScriptFile('/js/products.js');

?>
<script>
$(function () {
    Products.init();
});
</script>

<? foreach ($dataProvider->getData() as $product): ?>

    <div class="product">
        <div class="image"><img data-original="<?= CHtml::encode($this->imageUrl($product['id'])) ?>" alt="" /></div>
        <div class="name"><?= $product['id'] ?>. <?= CHtml::encode($product['name']) ?></div>
        <div class="price"><?= Yii::app()->numberFormatter->formatCurrency($product['price'], '&#8364;') ?></div>
        <div class="details"><?= CHtml::link('View details', ['site/details', 'id' => $product['id']]) ?></div>
        <div class="add"><?= CHtml::link('Add to the cart', ['site/add', 'id' => $product['id']]) ?></div>
    </div>

<? endforeach; ?>

<? if ($dataProvider->isFinished == false) : ?>
    <div class="loading"><?= CHtml::link('Load more', ['site/more', 'offset' => $dataProvider->nextOffset]) ?></div>
    <script>
        $(function () {
            Products.initScroll();
        });
    </script>
<? endif; ?>
