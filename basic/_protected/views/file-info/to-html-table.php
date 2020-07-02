<?php

use app\models\Company;
use app\models\Document;
use app\models\FileInfo;



//?>


<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #ddd;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even){background-color: #f2f2f2}

        .stil{

            overflow-x:auto;
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
</head>
<body>

<div id="stil" style="overflow-x:auto;">
    <button onclick="exportTableToExcel('tblData')">Ms Excel га юклаб олиш</button>
<div class="container-fluid" id="tblData">
    <?php
        $timezone  = +5; //(GMT -5:00) EST (U.S. & Canada)
        $currentDate = gmdate("j.m.Y H:i:s", time() + 3600*($timezone+date("I")));
    ?>


    <h4 style="text-align: center; width: auto" >Информация о  потребности в сумовых денежных средствах предприятий локализации (<?= $currentDate; ?>)</h4>
    <table id="" border="1">
        <thead>
        <tr>
            <th rowspan="4">№:</th>
            <th rowspan="4">Корхоналар</th>
            <th rowspan="4">Уникальный код</th>
            <th colspan="16" style="text-align: center">ОСТАТОК</th>
        </tr>
        <tr>
            <td colspan="4" style="text-align: center"> Асосий хисоб рақам</td>
            <td colspan="7" style="text-align: center">Махсус хисоб рақам</td>
            <td colspan="4" style="text-align: center">Депозит хисоб рақам</td>
            <td >Корпоратив карта</td>
        </tr>
        <tr>
            <td>UZS</td>
            <td>USD</td>
            <td>EUR</td>
            <td>RUB</td>
            <td>Акккредитив (USD)</td>
            <td>Акккредитив (EUR)</td>
            <td>Акккредитив (RUB)</td>
            <td>Блок счёт (UZS)</td>
            <td>Блок счёт (USD)</td>
            <td>Блок счёт (EUR)</td>
            <td>Блок счёт (RUB)</td>
            <td>Депозит (UZS)</td>
            <td>Депозит (USD)</td>
            <td>Депозит (EUR)</td>
            <td>Депозит (RUB)</td>
        </tr>
        <tr>
            <td>20208000/20210000/20214000</td>
            <td>20208840/20210840/20214840</td>
            <td>20208978/20210978/20214978</td>
            <td>20208643/20210643/20214643</td>
            <td>22602000</td>
            <td>22602840</td>
            <td>22602978</td>
            <td>22613000</td>
            <td>22618840</td>
            <td>22614978</td>
            <td>22614978</td>
            <td>20614000</td>
            <td>20614840</td>
            <td>20614978</td>
            <td>20614643</td>
            <td>22620</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($companyName as $i => $cName) {  ?>
         <tr>
            <td><?= $i; ?></td>
            <td><?= $cName->name; ?></td>
            <td><?= $cName->unical_code; ?></td>
        <?php for($j=0; $j<16; $j++){
                $arr = $summa[$cName->unical_code][$j] ? $summa[$cName->unical_code][$j] : [];
                $sum_new_array[$j] += array_sum($arr);?>
            <td><?= array_sum($arr); ?></td>
        <?php } ?>
        </tr>
        <?php } ?>
        <tr>
            <td colspan="3">Жами:</td>
            <?php for($j=0; $j<16; $j++){?>
            <td><?= $sum_new_array[$j]; ?></td>
            <?php } ?>
        </tr>
        </tbody>
    </table>
</div>
</div>




<script>
    var w = window.innerWidth;
    var h = window.innerHeight;
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




