<?

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;

$this->title = 'Xujjatlar';
$this->params['breadcrumbs'][] = $this->title;
?>


<style>
    .stil{
        overflow-x:auto;
    }
    .short{
        text-overflow: ellipsis ;
        white-space: nowrap ;
        width: 100px ;
        overflow: hidden;
        /*border: 1px solid #000000;*/
    }

</style>

<div >
    <?=Yii::$app->controller->renderPartial("//layouts/header")?>
</div>


<div class="container-fluid">
    <h1><?=$this->title ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

<div id="stil" class="stil" >
    <table  class=" table table-striped">


        <thead class="thed">
        <tr>
            <th>№</th>
            <th>Корхона</th>
            <th>МФО</th>
            <th> ИНН</th>
            <th>Хисоб рақам</th>
            <th>Сана</th>
            <th>Проводканинг сана</th>
            <th>Хамкор номи</th>
            <th>Хамкор ИНН</th>
            <th>Хамкор Х-Р</th>
            <th>Тўлов мақсади</th>
            <th>Валюта коди</th>
            <th>Кирим</th>
            <th>Чиқим</th>
            <th>Статус</th>
            <th>Шартнома санаси</th>
            <th>Шартнома Рақами</th>
        </tr>
        </thead>
        <tbody>
        <? foreach ($document as $key => $doc) { ?>
        <tr>
            <td><?=$key+1?></td>
            <td><?=$doc->file->companyName->short_name?></td>
            <td><?=$doc->file->bank_mfo?></td>
            <td><?=$doc->file->company_inn?></td>
            <td><?=$doc->file->company_account?></td>
            <td><?=$doc->file->file_date?>	</td>
            <td><?=$doc->detail_date?></td>
            <td><?=$doc->detail_name?></td>
            <td><?=$doc->detail_inn?></td>
            <td><?=$doc->detail_account?></td>

            <td>
                <div class="short">
                <a class="bank" href="<?=Url::to(['xujjat/views','id'=>$doc->id]);?>">
                <?=$doc->detail_purpose_of_payment?>
                    </a>
                </div>
            </td>

<!--            <a href="--><?//=Url::to(['maxsulot/update','id'=>$value->id]);?><!--"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>-->

<!--            <td><div class="short">--><?//=Html::a( $doc->detail_purpose_of_payment,
//            [Yii::$app->controller->id.'/views','id'=>$doc->id],['class'=>' bank'])?><!--</div></td>-->

<!--            Html::a('add_circle',-->
<!--            ['accountnumber/create?company_id='.$getID->id, 'id' => $val->id], ['class' => 'bankview material-icons']);?>-->

            <td><?=$doc->code_currency?></td>
            <td><?=$doc->code_currency?></td>
            <td><?=$doc->detail_debet?></td>
            <td><?=$doc->tip_deb_kred?></td>
            <td><?=$doc->contract_date?></td>
            <td><?=$doc->detail_document_number?></td>

        </tr>
        <?}?>
        </tbody>


    </table>
</div>
</div>


<?
Modal::begin([
//    'header' => 'Тўлов мақсади',
    'id' => 'modal',
]);
?>
<div id="modalContent">

</div>
<?php
Modal::end();
?>


<script>
    var w = window.innerWidth;
    // var h = window.innerHeight-190;
    var h = window.innerHeight-190;
    document.getElementById("stil").style.height = h+"px";
</script>