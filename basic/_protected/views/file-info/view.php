<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FileInfo */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'File Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>

<div class="file-info-view">

    <h1><?= Html::encode("Файлдан ўқиб олинган маълумотлар") ?></h1>

    <hr style="border: 5px solid darkslategrey">

    <p>
        <?= Html::a('+', ['create', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('!', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('-', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'bank_mfo',
            'company_account',
            'company_inn',
            'file_name',
            'file_date',
            'data_period',
        ],
    ]) ?>

    <hr style="border: 5px solid darkslategrey">
    <br>
    <br>

            <table class="table" width="100%">
                <thead  style="background: darkslategrey">
                    <th  width="5%">Сана: </th>
                    <th  width="15%">Хисоб рақам: </th>
                    <th  width="10%">ИНН: </th>
                    <th  width="10%">Хужжат номери: </th>
                    <th  width="5%">Банк МФО: </th>
                    <th  width="15%">Дебет: </th>
                    <th  width="15%">Кредит: </th>
                    <th  width="25%">Тўлов мақсади: </th>
                </thead>

    <?php foreach ($document as $value){ ?>

                <tr>
                    <td><?= $value->detail_date;  ?></td>
                    <td><?= $value->detail_account;  ?></td>
                    <td><?= $value->detail_inn;  ?></td>
                    <td><?= $value->detail_document_number;  ?></td>
                    <td><?= $value->detail_mfo;  ?></td>
                    <td><?= $value->detail_debet;  ?></td>
                    <td><?= $value->detail_kredit;  ?></td>
                    <td><?= $value->detail_purpose_of_payment;  ?></td>
                </tr>
    <?php

//        $debet = $document->sum($value->detail_debet);
//        $kredit = $value->sum($value->detail_kredit);
//        $cost = $silka->sum('click');

    } ?>

                <thead  style="background-color: gray">
                    <th colspan="5" >ЖАМИ: </th>
                    <th  ><?=$debet; ?></th>
<!--                    <th  >--><?//=$kredit; ?><!--</th>-->
                    <th  ></th>
                </thead>

            </table>


</div>
