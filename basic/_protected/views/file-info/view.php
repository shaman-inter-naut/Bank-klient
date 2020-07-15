<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FileInfo */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Файллар ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div  style="padding-bottom: 30px">
    <?=Yii::$app->controller->renderPartial("//layouts/header")?>
</div>
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
    .alert {
        padding: 20px;
        background-color: #f44336;
        color: white;
        opacity: 1;
        transition: opacity 0.6s;
        margin-bottom: 15px;
    }

    .alert.success {background-color: #4CAF50;}
    .alert.info {background-color: #2196F3;}
    .alert.warning {background-color: #ff9800;}

    .closebtn {
        margin-left: 15px;
        color: white;
        font-weight: bold;
        float: right;
        font-size: 22px;
        line-height: 20px;
        cursor: pointer;
        transition: 0.3s;
    }

    .closebtn:hover {
        color: black;
    }
</style>

<div class="container file-info-view">

    <h1><?= Html::encode("Файлдан олинган маълумотлар: ") ?></h1>

    <hr style="border: 5px solid darkslategrey">
    <?php if (
            isset($_SESSION['file_date'])
            && isset($_SESSION['detail_document_number'])
            && isset($_SESSION['detail_purpose_of_payment'])
            && isset($_SESSION['detail_debet'])
            && isset($_SESSION['detail_kredit'])
    ){
        ?>
        <div class="alert info" style="text-align: center">
            <span class="closebtn"></span>
            <b><h4 style="color:yellow">Маълумотлар муваффаққиятли ўқиб олинди !</h4></b><hr>
            <h6 style="color: black">Фақат, баъзи маълумотлар детализацияси базада мавжуд бўлганлиги учун сақланмади !</h6>
            <p>(Ушбу файлни ўчириб юбориш хам мумкин !)</p>
        </div>
        <?php session_destroy(); } ?>

    <div class="col-md-10"><b><?= Html::a('ФАЙЛЛАР', [Yii::$app->controller->id.'/index']); ?></b></div>
    <div class="col-md-2">
        <p class="pull-right">
<!--            --><?//= Html::a('+', ['create'], ['class' => 'btn btn-success']) ?>
            <?//= Html::a('!', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Ўчириш', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Сиз ушбу маълумотни чиндан хам ўчириб юбормоқчимисиз ?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    </div>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'bank_mfo',
            ['attribute'=>'name',
                'format'=>'raw',
//                '' => '',
                'value' => $get_company_name
            ],
            'company_account',
            'company_inn',
            ['attribute'=>'file_name',
                'format'=>'raw',
//                '' => '',
                'value' => function($data)
                {return Html::a($data->file_name, ['#']);}
            ],
            'file_date',

            'data_period_start',

            'data_period_end',

            ['attribute'=>'depozitBefore',
//                'value' => $getBeforeDeposit->stock,

            ],

            ['attribute'=>'depozitAfter',
                // 1-shablon bo`yicha OK
            //    'value' => $getAfterDeposit->stock,
                // 2-shablon bo`yicha sozlsh kerak
            ],
            'countDetailToRecord',
            'countDetailNoRecord',
        ],
    ]) ?>

    <br>
    <hr style="border: 2px dotted darkslategrey">
    <br>
    <br>

            <table class="table" width="100%">
                <thead  style="background: darkslategrey">
                    <th  width="5%">Сана: </th>
                    <th  width="15%">Хисоб рақам: </th>
<!--                    <th  width="10%">ИНН: </th>-->
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
<!--                    <td>--><?//= $value->detail_inn;  ?><!--</td>-->
                    <td><?= $value->detail_document_number;  ?></td>
                    <td><?= $value->detail_mfo;  ?></td>
                    <td><?= number_format($value->detail_debet, 2, ',', ' ')  ?></td>
                    <td><?= number_format($value->detail_kredit, 2, ',', ' ')  ?></td>
                    <td><?= $value->detail_purpose_of_payment;  ?></td>
                </tr>
    <?php

//        $debet = $document->sum($value->detail_debet);
//        $kredit = $value->sum($value->detail_kredit);
//        $cost = $silka->sum('click');

    } ?>

                <thead  style="background-color: gray">
                    <th colspan="4" >ЖАМИ: </th>
                    <th  ><?= number_format($allDebet, 2, ',', ' '); ?></th>
                    <th  ><?= number_format($allKredit, 2, ',', ' '); ?></th>
<!--                    <th  >--><?//=$kredit; ?><!--</th>-->
                </thead>

            </table>


</div>

<script>
    var close = document.getElementsByClassName("closebtn");
    var i;

    for (i = 0; i < close.length; i++) {
        close[i].onclick = function(){
            var div = this.parentElement;
            div.style.opacity = "0";
            setTimeout(function(){ div.style.display = "none"; }, 600);
        }
    }
</script>
