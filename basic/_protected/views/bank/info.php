<?
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;

$this->title = 'БАНКЛАР ВА ФИЛИАЛЛАР';
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
    <p><strong style="font-size: 24px">БАНКЛАР ВА ФИЛИАЛЛАР</strong></p>
</div>


<div class="tab">

    <ul class="banks">
        <?php  foreach($bank as $value) { ?>
            <li class="tablinks"><a href='/bank/info?id=<?= $value->id; ?>'
                                    onclick="getBranches(event, '<?= $value->id; ?>')"><b><?= $value->name . '<br>'; ?></b></a></li>
        <? } ?>
    </ul>

    <!--    <button class="tablinks" onclick="getBranches(event, 'infin')" id="defaultOpen">Инфин банк</button>-->

</div>

<div id='<?= $getID->id; ?>' class="tabcontent">
    <table class="table table-striped">


        <thead class="thed">
        <tr>
            <th><h4>№</h4></th>
            <th style=""><h4>
                    <div class="col-md-11"><?= $getID->name; ?> филиаллари</div>
                    <div class="col-md-1"><?= Html::a('add_circle',
                            ['bankbranch/create?bank_id='.$getID->id, 'id' => $val->id], ['class' => 'bankview material-icons']);?></div>
                </h4> </th>
            <th><h4>МФО</h4></th>
        </tr>
        </thead>


        <tbody>
        <?  foreach ($getBranchID as $key => $val){  ?>
            <tr>
                <th><?=$key+1?></th>
                <th style="text-align: left">
                    <button class="accordion"  style="color: darkgreen"><?= $val->short_name; ?></button>
                    <div class="panel">
                        <br>
                        <table class="table" border="1" width="100%">
                            <tr>
                                <td width="90%"><?= $val->name_branch; ?></td>
                                <td width="5%" >
                                    <?= Html::a('create', ['bankbranch/update', 'id' => $val->id], ['class' => 'bankview material-icons']);?>
                                </td>
                                <td width="5%">
<!--                                    --><?//= Html::a('delete_forever', ['bankbranch/delete', 'id' => $val->id], ['class' => ' material-icons']);?>
<!--                                    <a href="--><?//=Url::to(['bankbranch/delete','id'=>$value->id]);?>
<!--                                    " title="Delete" aria-label="Delete" data-pjax="0" data-confirm="Ushbu bo`lim o`chirib tashlansinmi?" method="post">-->
<!--                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"><i class="delete_forever"></i></span></a>-->
                                    <?= Html::a('delete_forever', ['/bankbranch/delete', 'id' => $val->id], [
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
                <th><?=$val->mfo?></th>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
</div>

<?
Modal::begin([
//    'header' => $getID->name ,
//        [
//            'name'=>$getID->name ,
//            'align' => 'center',
//    ],


    'id' => 'modal',
    'class'=> ' center font',
//    'text align' => 'center'
//    'options' => ['style' => 'align="center"'],

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
    document.getElementById("defaultOpen").click();
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

