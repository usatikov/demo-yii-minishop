<?php
/* @var $this AdminController */
/* @var $model Product */

$this->breadcrumbs = array(
    'Manage Products' => array('index'),
    'Update',
);

$this->menu = array(
    array('label' => 'Manage Products', 'url' => array('index')),
    array('label' => 'Create Product', 'url' => array('create')),
);
?>

<h1>Update Product <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>
