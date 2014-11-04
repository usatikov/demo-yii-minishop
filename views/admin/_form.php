<?php
/* @var $this AdminController */
/* @var $model Product */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'product-form',
        'htmlOptions' => [
            'enctype' => 'multipart/form-data',
        ],
    )); ?>

    <? if ($model->isNewRecord == false): ?>
        <div class="admin-product-image">
            <img src="<?= CHtml::encode($this->imageUrl($model['id'])) ?>" alt="" />
        </div>
    <? endif; ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 100)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'price'); ?>
        <?php echo $form->textField($model, 'price', array('size' => 9, 'maxlength' => 9)); ?>
        <?php echo $form->error($model, 'price'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php echo $form->textArea($model, 'description', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'image'); ?>
        <?= $form->fileField($model, 'image'); ?>
        <?= $form->error($model, 'image'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
