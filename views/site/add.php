<?php
/**
 * @var $this SiteController
 * @var $products string[]
 */

Yii::app()->clientScript->registerCssFile('/css/products.css');

?>

<div class="add-success">Product has been added to your cart.</div>

<h2>Your cart</h2>

<table>
    <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Amount</th>
    </tr>
    <? foreach ($products as $product): ?>
        <tr>
            <td><?= CHtml::encode($product['name']) ?></td>
            <td><?= Yii::app()->numberFormatter->formatCurrency($product['price'], '&#8364;') ?></td>
            <td><?= CHtml::encode($product['quantity']) ?></td>
            <td><?= Yii::app()->numberFormatter->formatCurrency($product['amount'], '&#8364;') ?></td>
        </tr>
    <? endforeach; ?>
</table>

<div class="full-amount">Full amount: <?= Yii::app()->numberFormatter->formatCurrency($fullAmount, '&#8364;') ?></div>
