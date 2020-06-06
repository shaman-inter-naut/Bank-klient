<?
use yii\helpers\Url;

$this->title = 'My Yii Application';
?>

<div class="info" style="margin-bottom: 15px; padding: 20px;">
    <p><strong style="font-size: 24px">Банклар ва филиаллари</strong></p>
</div>


<div class="tab">

    <?php  foreach($bank as $value) { ?>
        <a href='bank?id=<?= $value->id; ?>' class="tablinks"
           onclick="getBranches(event, '<?= $value->id; ?>')"><?= $value->name . '<br>'; ?></a>
     <? } ?>


<!--    <button class="tablinks" onclick="getBranches(event, 'infin')" id="defaultOpen">Инфин банк</button>-->

</div>

    <div id='<?= $idd ?>' class="tabcontent">
        <table class="table table-striped">
            <thead class="thed">
            <tr>
                <th><h4>№</h4></th>
                <th><h4><?= $bname; ?> филиаллари</h4> </th>
                <th><h4>МФО</h4></th>
            </tr>
            </thead>
            <tbody>
            <?  foreach ($getBranchID as $key => $val){  ?>
                <tr>
                    <th><?=$key+1?></th>
                    <th style="text-align: left"><?=$val->short_name?></th>
                    <th><?=$val->mfo?></th>
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

</body>
</html>
