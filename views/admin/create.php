<?php
/* @var $this AdminController */
/* @var $model Product */

$this->breadcrumbs = array(
    'Manage Products' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'Manage Products', 'url' => array('index')),
);
?>

<h1>Create Product</h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>
