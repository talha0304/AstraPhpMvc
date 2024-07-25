<?php
use app\core\form\Form;
/**
 * @var $model \app\models\user
 */
?>



<?php
/** @var $this \app\core\View */
$this->title = 'register';
?>


<h1 class="text-center mt-5">Register User</h1>

<div class="container">
    <?php $form = Form::begin('', 'post'); ?>
    <?php echo $form->field($model, 'firstname'); ?>
    <?php echo $form->field($model, 'lastname'); ?>
    <?php echo $form->field($model, 'email'); ?>
    <?php echo $form->field($model, 'password')->passwordField(); ?>
    <?php echo $form->field($model, 'ConfromPass')->passwordField(); ?>
    <input type="submit" class="btn btn-primary mt-5">
    <?php Form::end(); ?>

</div>

