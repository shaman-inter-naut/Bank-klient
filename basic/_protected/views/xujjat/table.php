<?

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
    <div>
        <h3 style="text-align: center">Qidiruv tizimi</h3>
<section style="padding: 10px 0">
<!--        --><?php // echo $this->render('_search', ['model' => $searchModel]); ?>

               <div>
<!--                   --><?// Pjax::begin(); ?>
                    <?php $form = ActiveForm::begin(); ?>
                <div class="col-md-3">
                    <?=DatePicker::widget([
                        'options' => [
                                'placeholder' => 'Санани киритинг',

                            ],
                        'name' => 'month',
                        'value' => $date,
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'dd.mm.yyyy'
                        ],
                    ]);?>
                </div>
                   <div class="form-group">
                       <?= Html::submitButton('Қидириш', ['class' => 'btn btn-primary']) ?>
                   </div>
                    <?php ActiveForm::end(); ?>
<!--                   --><?// Pjax::end(); ?>
            </div>
</section>
        <section  style="padding: 10px 0">
        <div style="padding-left: 15px">
        <input class="input" type="text" id="myInput1" onkeyup="myFunction1()" placeholder="Корхона.." title="Корхонани киритинг">
        <input class="input" type="text" id="myInput2" onkeyup="myFunction2()" placeholder="МФО.." title="МФОни киритинг">
        <input class="input" type="text" id="myInput3" onkeyup="myFunction3()" placeholder="ИНН.." title="ИННни киритинг">
        <input class="input" type="text" id="myInput4" onkeyup="myFunction4()" placeholder="Хисоб рақам.." title="Хисоб рақамни киритинг">
<!--        <input class="input" type="text" id="myInput5" onkeyup="myFunction5()" placeholder="date.." title="Хисоб рақамни киритинг">-->
        <input class="input" type="text" id="myInput7" onkeyup="myFunction7()" placeholder="Хамкор номи.." title="Хамкор номини киритинг">
        <input class="input" type="text" id="myInput8" onkeyup="myFunction8()" placeholder="Хамкор ИНН.." title="Хамкор ИННни киритинг">
        <input class="input" type="text" id="myInput9" onkeyup="myFunction9()" placeholder="Хамкор Х-Р.." title="Хамкор Х-Рни киритинг">
        <input class="input" type="text" id="myInput10" onkeyup="myFunction10()" placeholder="Тўлов мақсади.." title="Тўлов мақсадини киритинг">
        <input class="input" type="text" id="myInput11" onkeyup="myFunction11()" placeholder="Валюта коди.." title="Валюта кодини киритинг">
        </div>
        </section>
    </div>

<div class="container-fluid">
<!--    <h1>--><?//=$this->title ?><!--</h1>-->
    <? if ($document){?>
    <div id="stil" class="stil" >
    <table  class=" table table-striped" id="tblData">
        <thead class="thed">
        <tr>
            <th>№</th>
            <th>Корхона</th>
            <th>МФО</th>
            <th> ИНН</th>
            <th class="xlText">Хисоб рақам</th>
            <th>Сана</th>
            <th>Проводканинг сана</th>
            <th>Хамкор номи</th>
            <th>Хамкор ИНН</th>
            <th class="xlText">Хамкор Х-Р</th>
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
    var h = window.innerHeight-250;
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
<!--search-->
<script>
    function myFunction1() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput1");
        filter = input.value.toUpperCase();
        table = document.getElementById("tblData");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
    function myFunction2() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput2");
        filter = input.value.toUpperCase();
        table = document.getElementById("tblData");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
    function myFunction3() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput3");
        filter = input.value.toUpperCase();
        table = document.getElementById("tblData");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[3];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
    function myFunction4() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput4");
        filter = input.value.toUpperCase();
        table = document.getElementById("tblData");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[4];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
    function myFunction5() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput5");
        filter = input.value.toUpperCase();
        table = document.getElementById("tblData");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[5];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
    function myFunction7() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput7");
        filter = input.value.toUpperCase();
        table = document.getElementById("tblData");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[7];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
    function myFunction8() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput8");
        filter = input.value.toUpperCase();
        table = document.getElementById("tblData");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[8];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
    function myFunction9() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput9");
        filter = input.value.toUpperCase();
        table = document.getElementById("tblData");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[9];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
    function myFunction10() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput10");
        filter = input.value.toUpperCase();
        table = document.getElementById("tblData");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[10];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
    function myFunction11() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput11");
        filter = input.value.toUpperCase();
        table = document.getElementById("tblData");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[11];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

</script>
<!--<script>-->
<!--    $(document).ready(function () {-->
<!--        $(function () {-->
<!--            $("#myInput5").datepicker();-->
<!--        });-->
<!--        -->
<!--    });-->
<!--</script>-->
<!--<script> src="jquery.datetimepicker.full.min.js" </script>-->
<!--<script>-->
<!--    $('#myInput4').datetimepicker({-->
<!--        timepicker: false,-->
<!--        datepicker: true,-->
<!--        format: 'Y-M-d',-->
<!--        value: date('Y-m-d'),-->
<!--        weeks: true,-->
<!--    })-->
<!--</script>-->

<!--https://www.youtube.com/watch?v=Bv9XrpmdopI&t=844s-->