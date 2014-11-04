<?php
/* @var $this AdminController */
/* @var $model Product */

$this->breadcrumbs = array(
    'Manage Products',
);

$this->menu = array(
    array('label' => 'Create Product', 'url' => array('create')),
);
?>

<h1>Manage Products</h1>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
        &lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'product-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'name',
        'price',
        [
            'class' => 'CButtonColumn',
            'template' => '{update} {delete}',
        ],
    ),
)); ?>
