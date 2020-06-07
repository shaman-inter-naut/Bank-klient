<?
use yii\helpers\Url;

$this->title = 'My Yii Application';
?>

<div class="info" style="margin-bottom: 15px; padding: 20px;">
    <p><strong style="font-size: 24px">Банклар ва филиаллари</strong></p>
</div>


<div class="tab">


        <? foreach ($company as $key => $value){
        ?>
        <button class="tablinks" data-id="<?=$value->id?>"><?=$value->name?></button>
        <?}?>
</div>

<div id='infin' class="tabcontent">
    <table class="table table-striped">
        <thead class="thed">
        <tr>
            <th><h4>№</h4></th>
            <th><h4>Shartnomalar</h4> </th>
            <th><h4>МФО</h4></th>
        </tr>
        </thead>
        <tbody>

            <tr>
                <th>1</th>
                <th style="text-align: left" id="sasa">sasasas</th>
                <th id="vava">vaxaxaxa</th>
            </tr>
        
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
    var closebtns = document.getElementsByClassName("close");
    var i;

    for (i = 0; i < closebtns.length; i++) {
        closebtns[i].addEventListener("click", function() {
            this.parentElement.style.display = 'none';
        });
    }
</script>

</body>
</html>

<?php
$this->registerJs('
     $(".tablinks").click(function(e){
        e.preventDefault();
        var data = $(this).attr("data-id");
    //        console.log(data);
        $.get("cont",{val:data},function(response){
            if(response.result=="success") {
                $("#sasa").text(response.first_company);
                $("#vava").text(response.contract_number);
                }
            else console.log(response.result);
    });
        
    });
    ');
?>