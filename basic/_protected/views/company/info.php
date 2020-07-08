<?
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Корхона ва хисоб рақамлар';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .center{
        text-align: center;
    }
</style>
<div  style="padding-bottom: 30px">
    <?=Yii::$app->controller->renderPartial("//layouts/header")?>
</div>
<div class="container" >
<div class="info" style="margin-bottom: 15px; text-align: center; padding: 20px;">
    <p><strong style="font-size: 24px">КОРХОНА ХИСОБ РАКАМЛАРИ</strong></p>
</div>


<div class="tab">

    <ul class="banks">
        <?php  foreach($company as $value) { if ($value->id < 24){?>
            <li class="tablinks"><a href='/company/info?id=<?= $value->id; ?>'
                                    onclick="getBranches(event, '<?= $value->id; ?>')"><b><?= $value->name . '<br>'; ?></b></a></li>
        <? }} ?>
    </ul>

    <!--    <button class="tablinks" onclick="getBranches(event, 'infin')" id="defaultOpen">Инфин банк</button>-->

</div>

<div id='<?= $getID->id; ?>' class="tabcontent">
    <table class="table table-striped"  width="100%">
        <thead class="thed">
        <tr>
            <th width="5%"><h4>№</h4></th>
            <th width="45%" style=""><h4>

                    <div class="col-md-1 pull-right"><?= Html::a('add_circle',
                            ['accountnumber/create?company_id='.$getID->id, 'id' => $val->id], ['class' => 'bankview material-icons']);?></div>
                    <div class="col-md-11"><?= $getID->name; ?> нинг хисоб рақамлари</div>
                </h4> </th>
            <th width="15%"><h4> Қолдиқ:</h4></th>
<!--            <th width="10%"><h4> Статус:</h4></th>-->
            <th width="15%"><h4> Сана:</h4></th>
        </tr>
        </thead>
        <tbody>
        <?  foreach ($companyone as $key => $val){  ?>
            <tr>
                <th><?=$key+1?></th>
                <th style="text-align: left">
                    <button class="accordion"  style="color: darkgreen"><?= $val->bankbr->short_name; ?></button>
                    <div class="panel">
                        <br>
                        <table class="table" border="1" width="100%">
                            <tr>
                                <td width="90%"><?= $val->account_number; ?></td>
                                <td width="5%" >
                                    <?= Html::a('create', ['accountnumber/update', 'id' => $val->id], ['class' => 'bankview material-icons']);?>
                                </td>
                                <td width="5%">
                                    <!--                                    --><?//= Html::a('delete_forever', ['bankbranch/delete', 'id' => $val->id], ['class' => ' material-icons']);?>
                                    <!--                                    <a href="--><?//=Url::to(['bankbranch/delete','id'=>$value->id]);?>
                                    <!--                                    " title="Delete" aria-label="Delete" data-pjax="0" data-confirm="Ushbu bo`lim o`chirib tashlansinmi?" method="post">-->
                                    <!--                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"><i class="delete_forever"></i></span></a>-->
                                    <?= Html::a('delete_forever', ['/accountnumber/delete', 'id' => $val->id], [
                                        'class' => 'bankview material-icons',
                                        'data' => [
                                            'confirm' => 'Ўчириб юборилсинми?',
                                            'method' => 'post',
                                        ],
                                    ]) ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </th>
                <th><?= $val->stock?></th>
                <th><?= $val->stock_date?></th>
            </tr>
        <?php } ?>
        </tbody>














    </table>
</div>
</div>
<?
Modal::begin([
//    'header' => $getID->name,
    'id' => 'modal',
]);
?>
<div id="modalContent">

</div>
<?php
Modal::end();
?>


<script>
    function getBranches(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("<?php echo ($getID->id == null) ? '?id=1' : ''; ?>").click();
</script>

<script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
            }
        });
    }
</script>

