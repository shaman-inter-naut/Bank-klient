<?php
/* @var $this yii\web\View */

$this->title = Yii::t('app', Yii::$app->name);
?>

<style type="text/css">


</style>

<div class="site-index">


    <div class="body-content">

        <div class="row">

            <h1>Ma'lumot</h1>

            <div>

                <table class="table table-striped">


                    <thead class="thed">
                    <tr>
                        <th>T/R</th>
                        <th>Korxonalar</th>
                        <? foreach ($bank as $key => $value ) { ?>
                            <th><?=$value->name?></th>
                        <? } ?>



                    </tr>
                    </thead>

                    <tbody>
                    <? foreach ($company as $key => $item) {

                        ?>
                        <tr>
                            <th scope="row"><?=$key+1?></th>
                            <td><?=$item->name?></td>
                            <td>
                                3
                            </td>
                            <td>4</td>
                            <td>5</td>
                            <td>7</td>
                            <td>8</td>
                            <td>9</td>
                            <td>10</td>
                            <td>11</td>
                            <td>12</td>
                            <td>13</td>
                            <td>14</td>
                            <td>15</td>
                            <td>16</td>
                        </tr>
                    <?}?>

                    </tbody>
                </table>


            </div>
        </div>



