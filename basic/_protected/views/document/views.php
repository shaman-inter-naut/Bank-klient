<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $model app\models\Document */

$this->title = 'Тўлов мақсади';
$this->params['breadcrumbs'][] = ['label' => 'Documents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<h4 style="text-align: center; color:#1c7430"><?= Html::encode($this->title) ?></h4>
<div class="document-view">

    <h4 style="text-align: center;"><?=$model->detail_purpose_of_payment?></h4>


   

</div>
