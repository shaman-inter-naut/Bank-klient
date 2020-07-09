<?
use yii\helpers\ArrayHelper;
use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use dosamigos\datetimepicker\DateTimePicker;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

$this->title = 'Xujjatlar';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>


    .inputform {
        /*background-image: url('/themes/searchicon.png');*/
        background-position: 10px 10px;
        background-repeat: no-repeat;
        width: 15%;
        /*height: 40px;*/
        font-size: 12px;
        /*padding: 12px 0 12px 5px;*/
        border: 1px solid #ddd;
        margin-bottom: 12px;
    }

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

    .xlText {
        mso-number-format: "\@";
    }

</style>

<script>
    function exportTableToExcel(tableID, filename = ''){
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var tableSelect = document.getElementById(tableID);
        var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

        // Specify file name
        filename = filename?filename+'.xls':'excel_data.xls';

        // Create download link element
        downloadLink = document.createElement("a");

        document.body.appendChild(downloadLink);

        if(navigator.msSaveOrOpenBlob){
            var blob = new Blob(['\ufeff', tableHTML], {
                type: dataType
            });
            navigator.msSaveOrOpenBlob( blob, filename);
        }else{
            // Create a link to the file
            downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

            // Setting the file name
            downloadLink.download = filename;

            //triggering the function
            downloadLink.click();
        }
    }
</script>

<div >
    <?=Yii::$app->controller->renderPartial("//layouts/header")?>
</div>

        <h3 style="text-align: center">Қидирув тизими</h3>
        <section style="padding: 10px 0">
<!--        --><?php // echo $this->render('_search', ['model' => $searchModel]); ?>


                <div class="col-md-3">
                    <?php $form = ActiveForm::begin(); ?>

                    <?=DatePicker::widget([
                        'options' => [
                            'placeholder' => 'Хужжат яратилган санани киритинг',
                            'class'=> 'inputform',
                        ],
                        'name' => 'date',
//                        'value' => $date,
//                        'value' => $_POST['date'] ? $_POST['date'] : [],
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'dd.mm.yyyy'
                        ],
                    ]);?>
                </div>
            <div class="col-md-3">
                <?=DatePicker::widget([
                    'options' => [
                        'placeholder' => 'Шартнома санасини киритинг',
                        'class'=> 'inputform',
                    ],
                    'name' => 'contract_date',
//                    'value' => $contract_date,
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd.mm.yyyy'
                    ],
                ]);?>
            </div>
            <div class="col-md-3">
                <?= DatePicker::widget([
                    'options' => ['placeholder' => 'Проводка(Дан...)',
                        // 'value' => date('Y-m-d')
                        'class'=> 'inputform',
                    ],
                    'name'=> 'startDT',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' =>'yyyy-mm-dd'
                    ]
                ]); ?>
            </div>
            <div class="col-md-3">
                <?= DatePicker::widget([
                    'options' => ['placeholder' => 'Проводка(Дан...)',
                        // 'value' => date('Y-m-d')
                        'class'=> 'inputform',
                    ],
                    'name'=> 'endDT',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' =>'yyyy-mm-dd'
                    ]
                ]); ?>
            </div>
        </section>

        <section style="padding: 0 0 0 15px">

                           <?$options = ['class'=> 'inputform','placeholder' => 'Хамкор ИНН ни киритинг'] ?>
                           <?= Html::textInput('detail_inn',null , $options) ?>

                           <?$options = ['class'=> 'inputform','placeholder' => 'Хамкор Х-Рни киритинг'] ?>
                           <?= Html::textInput('detail_account',null , $options) ?>

                            <?$options = ['class'=> 'inputform','placeholder' => 'Тўлов мақсадини киритинг'] ?>
                            <?= Html::textInput('detail_purpose_of_payment',null , $options) ?>

                            <?$options = ['class'=> 'inputform','placeholder' => 'Валюта кодини киритинг'] ?>
                            <?= Html::textInput('code_currency',null , $options) ?>

                            <?
                            $items=[
                            Null=>'Кирим-чиқим турини танланг',
                            1=>'Кирим',
                            0=>'Чиқим',
                            ];?>

                            <?$options = ['class'=> 'inputform','placeholder' => 'Валюта кодини киритинг'] ?>
                            <?= Html::dropDownList('tip_deb_kred',null , $items,$options) ?>

                            <?$options = ['class'=> 'inputform','placeholder' => 'Хамкор номини киритинг'] ?>
                            <?= Html::textInput('detail_name',null , $options) ?>

                            <?$options = ['class'=> 'inputform','placeholder' => 'Хисоб рақамни киритинг'] ?>
                            <?= Html::textInput('company_account',null , $options) ?>

                            <?$options = ['class'=> 'inputform','placeholder' => 'МФОни киритинг'] ?>
                            <?= Html::textInput('bank_mfo',null , $options) ?>

                            <?$options = ['class'=> 'inputform','placeholder' => 'ИННни киритинг'] ?>
                            <?= Html::textInput('company_inn',null , $options) ?>

                            <?$options = ['class'=> 'inputform','placeholder' => 'Корхонани киритинг'] ?>
                            <?= Html::textInput('short_name',null , $options) ?>
<!--                            --><?//= Html::dropDownList('short_name',null ,  [ null=>'Корхонани киритинг', ArrayHelper::map(\app\models\Company::find()->all(),'id','short_name')],$options) ?>



                            <?= Html::submitButton('Қидириш', ['class' => 'btn btn-primary']) ?>
                            <?= Html::submitButton('Reset', ['class' => 'btn btn-success']) ?>


                    <?php ActiveForm::end(); ?>
<!--                   --><?// Pjax::end(); ?>

</section>


<div class="container-fluid">
<!--    <h1>--><?//=$this->title ?><!--</h1>-->
    <? if ($document){?>
    <div id="stil" class="stil" >

        <br>
    <table  border="1"  class=" table table-striped" id="tblData">
        <thead   class="thed">
        <tr style="text-align: center; background-color: white; color: darkblue; height: 50px;">
            <th colspan="16">
                <h4 >Барча проводкалар хақида маълумот</h4>
            </th>
        </tr>
        <tr  >
            <th style="background-color: darkgreen; color: white; height: 100px;">№</th>
            <th style="background-color: darkgreen; color: white; height: 100px;">Корхона</th>
            <th style="background-color: darkgreen; color: white; height: 100px;">МФО</th>
            <th style="background-color: darkgreen; color: white; height: 100px;"> ИНН</th>
            <th class="xlText" style="background-color: darkgreen; color: white; height: 100px;">Хисоб рақам</th>
            <th style="background-color: darkgreen; color: white; height: 100px;">Хужжат яратилган сана</th>
            <th style="background-color: darkgreen; color: white; height: 100px;">Проводканинг сана</th>
            <th style="background-color: darkgreen; color: white; height: 100px;">Хамкор номи</th>
            <th style="background-color: darkgreen; color: white; height: 100px;">Хамкор ИНН</th>
            <th class="xlText" style="background-color: darkgreen; color: white; height: 100px;">Хамкор Х-Р</th>
            <th style="background-color: darkgreen; color: white; height: 100px;">Тўлов мақсади</th>
            <th style="background-color: darkgreen; color: white; height: 100px;">Валюта коди</th>
            <th style="background-color: darkgreen; color: white; height: 100px;">Кирим</th>
            <th style="background-color: darkgreen; color: white; height: 100px;">Чиқим</th>
<!--            <th>Статус</th>-->
            <th style="background-color: darkgreen; color: white; height: 100px;">Шартнома санаси</th>
            <th style="background-color: darkgreen; color: white; height: 100px;">Шартнома Рақами</th>
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
            <td><?=$doc->file->file_date?></td>
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
            <td><?=$doc->detail_debet?></td>
            <td><?=$doc->detail_kredit?></td>
<!--            <td>--><?//=$doc->tip_deb_kred?><!--</td>-->
            <td><?=$doc->contract_date?></td>
            <td><?=$doc->detail_document_number?></td>

        </tr>
        <?}?>
        </tbody>


    </table>
        <div class="col-sm-6 text-left">
            <?= LinkPager::widget([
                'pagination' => $pagination,
            ]);?>
        </div>
</div>
    <?}?>
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

<meta name="viewport" content="width=device-width, initial-scale=1">
<script>
    var w = window.innerWidth;
    // var h = window.innerHeight-190;
    var h = window.innerHeight-290;
    document.getElementById("stil").style.height = h+"px";
</script>

<script type="text/javascript">
    function tableau(pid, iid, fmt, ofile) {
        if(typeof Downloadify !== 'undefined') Downloadify.create(pid,{
            swf: 'downloadify.swf',
            downloadImage: 'download.png',
            width: 100,
            height: 30,
            filename: ofile, data: function() { return doit(fmt, ofile, true); },
            transparent: false,
            append: false,
            dataType: 'base64',
            onComplete: function(){ alert('Your File Has Been Saved!'); },
            onCancel: function(){ alert('You have cancelled the saving of this file.'); },
            onError: function(){ alert('You must put something in the File Contents or there will be nothing to save!'); }
        }); else document.getElementById(pid).innerHTML = "";
    }
    tableau('biff8btn', 'xportbiff8', 'biff8', 'SheetJSTableExport.xls');
    tableau('odsbtn',   'xportods',   'ods',   'SheetJSTableExport.ods');
    tableau('fodsbtn',  'xportfods',  'fods',  'SheetJSTableExport.fods');
    tableau('xlsbbtn',  'xportxlsb',  'xlsb',  'SheetJSTableExport.xlsb');
    tableau('xlsxbtn',  'xportxlsx',  'xlsx',  'SheetJSTableExport.xlsx');

</script>

<!--https://www.youtube.com/watch?v=Bv9XrpmdopI&t=844s-->