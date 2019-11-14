<?php
    use yii\helpers\Html;
    $this->title = 'Redirect Error';
?>

<div class="site-error">

    <div class="alert alert-danger text-center">
        <?= nl2br(Html::encode($message)) ?>
    </div>

</div>
