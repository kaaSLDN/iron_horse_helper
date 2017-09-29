<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProductTag */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Product Tag',
]) . $model->product_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product Tags'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->product_id, 'url' => ['view', 'product_id' => $model->product_id, 'tag_id' => $model->tag_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="product-tag-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
