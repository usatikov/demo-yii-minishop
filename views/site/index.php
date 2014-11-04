<?php
/**
 * @var $this SiteController
 * @var $dataProvider ProductProvider
 */

$this->pageTitle = Yii::app()->name;
?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<p>Congratulations! You have successfully opened this cosy demo application.</p>

<div class="products">
    <? $this->renderPartial('_products', ['dataProvider' => $dataProvider]); ?>
</div>
