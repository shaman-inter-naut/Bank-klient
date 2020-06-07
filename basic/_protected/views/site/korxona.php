<?

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'My Yii Application';
?>

<div class="info" style="margin-bottom: 15px; text-align: center; padding: 20px;">
    <p><strong style="font-size: 24px">БАНКЛАР ВА ФИЛИАЛЛАР</strong></p>
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
                    <div class="col-md-11"><?= $getID->name; ?> Шартномалари</div>
                    <div class="col-md-1"><?= Html::a('add_circle', ['contracts/create', 'id' => $val->id], ['class' => 'material-icons']);?></div>
                </h4> </th>
            <th><h4 style="width: 50px;">Шартнома вакти</h4></th>
        </tr>
        </thead>
        <tbody>
        <?  foreach ($getContractID as $key => $val){  ?>
            <tr>
                <th><?=$key+1?></th>
                <th style="text-align: left">
                    <button class="accordion"  style="color: darkgreen"><?= $val->contract_number; ?></button>
                    <div class="panel">
                        <br>
                        <table class="table" border="1" width="100%">
                            <tr>
                                <td width="90%"><?= $val->contract_number; ?></td>
                                <td width="5%" >
                                    <?= Html::a('create', ['contracts/update', 'id' => $val->id], ['class' => 'material-icons']);?>
                                </td>
                                <td width="5%">
                                    <?= Html::a('delete_forever', ['contracts/view', 'id' => $val->id], ['class' => 'material-icons']);?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </th>
                <th><?=date("d-m-Y",$val->contract_date)?></th>

            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>



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



</body>
</html>
