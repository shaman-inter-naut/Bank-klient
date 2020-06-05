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
</div>

<div id="asaka" class="tabcontent">
    <h3>Асака банк</h3>
    <p>Асака банк</p>
</div>

<div id="hamkor" class="tabcontent">
    <h3>Хамкор банк</h3>
    <p>Хамкор банк</p>
</div>

<div id="ipakyoli" class="tabcontent">
    <h3>Ипак йўли банк</h3>
    <p>Ипак йўли банк</p>
</div>

<div id="sanoatqur" class="tabcontent">
    <h3>ПСБ</h3>
    <p>ПСБ</p>
</div>

<div id="kapital" class="tabcontent">
    <h3>Капитал банк</h3>
    <p>Капитал банк</p>
</div>

<div id="milliy" class="tabcontent">
    <h3>Миллий банк</h3>
    <p>Миллий банк</p>
</div>

<div id="aloqa" class="tabcontent">
    <h3>Алока банк</h3>
    <p>Алока банк</p>
</div>

<div id="trast" class="tabcontent">
    <h3>Траст банк</h3>
    <p>Траст банк</p>
</div>

<div id="halq" class="tabcontent">
    <h3>Халқ банки</h3>
    <p>Халқ банки</p>
</div>

<div id="ipoteka" class="tabcontent">
    <h3>Ипотека банк</h3>
    <p>Ипотека банк</p>
</div>

<div id="kdb" class="tabcontent">
    <h3>Азиа Аллианс банк</h3>
    <p>Азиа Аллианс банк</p>
</div>

<div id="asiaalians" class="tabcontent">
    <h3>КДБ</h3>
    <p>КДБ</p>
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
