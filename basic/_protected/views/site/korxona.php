<?
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'My Yii Application';


?>

<div class="info" style="margin-bottom: 15px; text-align: center; padding: 20px;">
    <p><strong style="font-size: 24px">КОРХОНА ХИСОБ РАКАМЛАРИ</strong></p>
</div>


<div class="tab">

    <ul class="banks">
        <?php  foreach($company as $value) { ?>
            <li class="tablinks"><a href='korxona?id=<?= $value->id; ?>'
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
                    <div ><?= $getID->name; ?>нинг банк филиаллари </div>
<!--                    <div class="col-md-1">--><?//= Html::a('add_circle', ['/create', 'id' => $val->id], ['class' => 'material-icons']);?><!--</div>-->
                </h4> </th>
            <th><h4>
                    <div class="col-md-9">
                        ХИСОБ РАКАМ
                    </div>

                    <div class="col-md-3">
                        <?= Html::a('add_circle', ['accountnumber/create', 'id' => $val->id], ['class' => 'kor material-icons']);?>

                    </div>



                </h4></th>
<!--            <th><h4>МФО</h4></th>-->
        </tr>
        </thead>
        <tbody>
        <?  foreach ( $companyone as $key => $val){  ?>
            <tr>
                <th><?=$key+1?></th>
                <th style="text-align: left; vertical-align: center !important;"><?=$val->bankbr->short_name?></th>
                <th style="text-align: left">
                    <button  class="accordion"  style="color: darkgreen; padding: 10px"><?= $val->account_number; ?></button>
                    <div class="panels">
                        <br>
                        <table class="table" border="1" width="100%">
                            <tr>
                                <td ><?= $val->account_number; ?></td>
                                <td  >
                                    <?= Html::a('create', ['accountnumber/update', 'id' => $val->id], ['class' => 'kor material-icons']);?>
                                </td>
                                <td >
                                    <?= Html::a('delete_forever', ['accountnumber/view', 'id' => $val->id], ['class' => 'material-icons']);?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </th>
<!--                <th>--><?//=$val->account_number?><!--</th>-->

            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<?
Modal::begin([
    'header' => '<h3>Хисоб ракам кошиш</h3>',
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

