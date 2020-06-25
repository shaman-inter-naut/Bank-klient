<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FileInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Банк клиент';
?>

<div class="site-index" >

<br>
    <br>
    <div class="tab" >
        <button class="tablinks" onclick="openCity(event, 'London')" id="defaultOpen">Бош сахифа</button>
        <button class="tablinks" onclick="openCity(event, 'Paris')">Банклар</button>
        <button class="tablinks" onclick="openCity(event, 'Tokyo')">Корхоналар</button>
    </div>


    <div id="London" class="tabcontent row">
        <div class="card  col-md-4">
            <img src="/web/image/img_avatar2.png" alt="Avatar" style="width:50%">
            <div class="container">
                <h4><b>Jane Doe</b></h4>
                <p>Interior Designer</p>
            </div>
        </div>

        <div class="card col-md-4">
            <img src="/web/image/img_avatar2.png" alt="Avatar" style="width:50%">
            <div class="container">
                <h4><b>Jane Doe</b></h4>
                <p>Interior Designer</p>
            </div>
        </div>

        <div class="card col-md-4">
            <img src="/web/image/img_avatar2.png" alt="Avatar" style="width:50%">
            <div class="container">
                <h4><b>Jane Doe</b></h4>
                <p>Interior Designer</p>
            </div>
        </div>
    </div>

    <div id="Paris" class="tabcontent">
        <h3>Paris</h3>
        <p>Paris is the capital of France.</p>
    </div>

    <div id="Tokyo" class="tabcontent">
        <h3>Tokyo</h3>
        <p>Tokyo is the capital of Japan.</p>
    </div>

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

