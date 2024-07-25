<?php

use app\core\form\Form;
use app\core\form\TextareaField;

/** @var $model \app\models\ContactForm */
/** @var $this \app\core\View */


$this->title = 'Contact';

?>

<h1 class="text-center mt-5">Contact</h1>




<div class="container">
    <?php $form = Form::begin('', 'post'); ?>
    <?php echo $form->field($model, 'name'); ?>
    <?php echo $form->field($model, 'email'); ?>
    <?php echo new TextareaField($model, 'message'); ?>
    <input type="submit" class="btn btn-primary mt-5">
    <?php Form::end(); ?>

</div>

