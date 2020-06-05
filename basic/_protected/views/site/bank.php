<?
use yii\helpers\Url;

$this->title = 'My Yii Application';
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {box-sizing: border-box}
        body {font-family: "Lato", sans-serif;}

        /* Style the tab */


/*// next stil        */


        .info {
            background-color: #e7f3fe;
            border-left: 6px solid #2196F3;
        }

    </style>
</head>
<body>

<div class="info" style="margin-bottom: 15px; padding: 20px;">
    <p><strong style="font-size: 20px">BANKLAR </strong> va ularning filiallari ...</p>
</div>


<div class="tab">
    <button class="tablinks" onclick="openCity(event, 'infin')" id="defaultOpen">Инфин банк</button>
    <button class="tablinks" onclick="openCity(event, 'asaka')">Асака банк</button>
    <button class="tablinks" onclick="openCity(event, 'hamkor')">Хамкор банк</button>
    <button class="tablinks" onclick="openCity(event, 'ipakyoli')">Ипак йўли банк</button>
    <button class="tablinks" onclick="openCity(event, 'sanoatqur')">ПСБ</button>
    <button class="tablinks" onclick="openCity(event, 'kapital')">Капитал банк</button>
    <button class="tablinks" onclick="openCity(event, 'milliy')">Миллий банк</button>
    <button class="tablinks" onclick="openCity(event, 'aloqa')">Алока банк</button>
    <button class="tablinks" onclick="openCity(event, 'trast')">Траст банк</button>
    <button class="tablinks" onclick="openCity(event, 'halq')">Халқ банки</button>
    <button class="tablinks" onclick="openCity(event, 'ipoteka')">Ипотека банк</button>
    <button class="tablinks" onclick="openCity(event, 'kdb')">КДБ</button>
    <button class="tablinks" onclick="openCity(event, 'asiaalians')">Азиа Аллианс банк</button>
</div>

<div id="infin" class="tabcontent">
    <h3>Инфин банк</h3>
    <p>Инфин банк</p>



    <table class="table table-striped">
        <thead class="thed">
        <tr>
            <th>№</th>
            <th>Банк филиали номи</th>
            <th>МФО</th>

        </tr>
        </thead>
        <tbody>
        <? foreach ($bank1->bankBranches as $key => $value){ ?>
        <tr class="left">
            <th><?=$key+1?></th>
            <thstyle="text-align: left"><?=$value->short_name?></th>
            <th><?=$value->mfo?></th>
        </tr>
        <?}?>
        </tbody>

    </table>





</div>

<div id="asaka" class="tabcontent">
    <h3>Асака банк</h3>
    <p>Асака банк</p>


    <table class="table table-striped">
        <thead class="thed">
        <tr>
            <th>№</th>
            <th>Банк филиали номи</th>
            <th>МФО</th>

        </tr>
        </thead>
        <tbody>
        <? foreach ($bank2->bankBranches as $key => $value){ ?>
            <tr>
                <th><?=$key+1?></th>
                <th style="text-align: left"><?=$value->short_name?></th>
                <th><?=$value->mfo?></th>
            </tr>
        <?}?>
        </tbody>

    </table>
</div>

<div id="hamkor" class="tabcontent">
    <h3>Хамкор банк</h3>
    <p>Хамкор банк</p>
    <table class="table table-striped">
        <thead class="thed">
        <tr>
            <th>№</th>
            <th>Банк филиали номи</th>
            <th>МФО</th>

        </tr>
        </thead>
        <tbody>
        <? foreach ($bank3->bankBranches as $key => $value){ ?>
            <tr>
                <th><?=$key+1?></th>
                <th style="text-align: left"><?=$value->short_name?></th>
                <th><?=$value->mfo?></th>
            </tr>
        <?}?>
        </tbody>

    </table>
</div>

<div id="ipakyoli" class="tabcontent">
    <h3>Ипак йўли банк</h3>
    <p>Ипак йўли банк</p>
    <table class="table table-striped">
        <thead class="thed">
        <tr>
            <th>№</th>
            <th>Банк филиали номи</th>
            <th>МФО</th>

        </tr>
        </thead>
        <tbody>
        <? foreach ($bank4->bankBranches as $key => $value){ ?>
            <tr>
                <th><?=$key+1?></th>
                <th style="text-align: left"><?=$value->short_name?></th>
                <th><?=$value->mfo?></th>
            </tr>
        <?}?>
        </tbody>

    </table>
</div>

<div id="sanoatqur" class="tabcontent">
    <h3>ПСБ</h3>
    <p>ПСБ</p>
    <table class="table table-striped">
        <thead class="thed">
        <tr>
            <th>№</th>
            <th>Банк филиали номи</th>
            <th>МФО</th>

        </tr>
        </thead>
        <tbody>
        <? foreach ($bank5->bankBranches as $key => $value){ ?>
            <tr>
                <th><?=$key+1?></th>
                <th style="text-align: left"><?=$value->short_name?></th>
                <th><?=$value->mfo?></th>
            </tr>
        <?}?>
        </tbody>

    </table>
</div>

<div id="kapital" class="tabcontent">
    <h3>Капитал банк</h3>
    <p>Капитал банк</p>
    <table class="table table-striped">
        <thead class="thed">
        <tr>
            <th>№</th>
            <th>Банк филиали номи</th>
            <th>МФО</th>

        </tr>
        </thead>
        <tbody>
        <? foreach ($bank6->bankBranches as $key => $value){ ?>
            <tr>
                <th><?=$key+1?></th>
                <th style="text-align: left"><?=$value->short_name?></th>
                <th><?=$value->mfo?></th>
            </tr>
        <?}?>
        </tbody>

    </table>
</div>

<div id="milliy" class="tabcontent">
    <h3>Миллий банк</h3>
    <p>Миллий банк</p>
    <table class="table table-striped">
        <thead class="thed">
        <tr>
            <th>№</th>
            <th>Банк филиали номи</th>
            <th>МФО</th>

        </tr>
        </thead>
        <tbody>
        <? foreach ($bank7->bankBranches as $key => $value){ ?>
            <tr>
                <th><?=$key+1?></th>
                <th style="text-align: left"><?=$value->short_name?></th>
                <th><?=$value->mfo?></th>
            </tr>
        <?}?>
        </tbody>

    </table>
</div>

<div id="aloqa" class="tabcontent">
    <h3>Алока банк</h3>
    <p>Алока банк</p>
    <table class="table table-striped">
        <thead class="thed">
        <tr>
            <th>№</th>
            <th>Банк филиали номи</th>
            <th>МФО</th>

        </tr>
        </thead>
        <tbody>
        <? foreach ($bank8->bankBranches as $key => $value){ ?>
            <tr>
                <th><?=$key+1?></th>
                <th style="text-align: left"><?=$value->short_name?></th>
                <th><?=$value->mfo?></th>
            </tr>
        <?}?>
        </tbody>

    </table>
</div>

<div id="trast" class="tabcontent">
    <h3>Траст банк</h3>
    <p>Траст банк</p>
    <table class="table table-striped">
        <thead class="thed">
        <tr>
            <th>№</th>
            <th>Банк филиали номи</th>
            <th>МФО</th>

        </tr>
        </thead>
        <tbody>
        <? foreach ($bank9->bankBranches as $key => $value){ ?>
            <tr>
                <th><?=$key+1?></th>
                <th style="text-align: left"><?=$value->short_name?></th>
                <th><?=$value->mfo?></th>
            </tr>
        <?}?>
        </tbody>

    </table>
</div>

<div id="halq" class="tabcontent">
    <h3>Халқ банки</h3>
    <p>Халқ банки</p>
    <table class="table table-striped">
        <thead class="thed">
        <tr>
            <th>№</th>
            <th>Банк филиали номи</th>
            <th>МФО</th>

        </tr>
        </thead>
        <tbody>
        <? foreach ($bank10->bankBranches as $key => $value){ ?>
            <tr>
                <th><?=$key+1?></th>
                <th style="text-align: left"><?=$value->short_name?></th>
                <th><?=$value->mfo?></th>
            </tr>
        <?}?>
        </tbody>

    </table>
</div>

<div id="ipoteka" class="tabcontent">
    <h3>Ипотека банк</h3>
    <p>Ипотека банк</p>
    <table class="table table-striped">
        <thead class="thed">
        <tr>
            <th>№</th>
            <th>Банк филиали номи</th>
            <th>МФО</th>

        </tr>
        </thead>
        <tbody>
        <? foreach ($bank11->bankBranches as $key => $value){ ?>
            <tr>
                <th><?=$key+1?></th>
                <th style="text-align: left"><?=$value->short_name?></th>
                <th><?=$value->mfo?></th>
            </tr>
        <?}?>
        </tbody>

    </table>
</div>

<div id="kdb" class="tabcontent">
    <h3>Азиа Аллианс банк</h3>
    <p>Азиа Аллианс банк</p>
    <table class="table table-striped">
        <thead class="thed">
        <tr>
            <th>№</th>
            <th>Банк филиали номи</th>
            <th>МФО</th>

        </tr>
        </thead>
        <tbody>
        <? foreach ($bank12->bankBranches as $key => $value){ ?>
            <tr>
                <th><?=$key+1?></th>
                <th style="text-align: left"><?=$value->short_name?></th>
                <th><?=$value->mfo?></th>
            </tr>
        <?}?>
        </tbody>

    </table>
</div>

<div id="asiaalians" class="tabcontent">
    <h3>КДБ</h3>
    <p>КДБ</p>
    <table class="table table-striped">
        <thead class="thed">
        <tr>
            <th>№</th>
            <th>Банк филиали номи</th>
            <th>МФО</th>

        </tr>
        </thead>
        <tbody>
        <? foreach ($bank13->bankBranches as $key => $value){ ?>
            <tr>
                <th><?=$key+1?></th>
                <th style="text-align: left"><?=$value->short_name?></th>
                <th><?=$value->mfo?></th>
            </tr>
        <?}?>
        </tbody>

    </table>
</div>

<script>
    function openCity(evt, cityName) {
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
