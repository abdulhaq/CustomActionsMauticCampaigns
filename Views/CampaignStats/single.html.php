<?php

/*
 * @copyright   2019 Mautic Contributors. All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
if ($tmpl == 'index') {
    //$view->extend('MauticSqlConditionsBundle:SqlConditions:index.html.php');
}
$view->extend('MauticCoreBundle:Standard:index.html.php');
/* @var \MauticPlugin\MauticSqlConditionsBundle\Entity\SqlConditions[] $items */
$view['slots']->set('headerTitle', 'Test Campaign Stats');
?>
<script>
    //alert('sdd');
    // jQuery('.CampaignStats-list a').each(function() {
    //     jQuery(this).attr("href", '/v441/s/campaign-stats/view/1');
    // });
</script>
<div style="display:none; padding: 10px 20px; text-align: center;">
    <div class="row">
        <div class="col-sm-2">
            <h1>20k</h1>
            <p class="mt-10">Total Pros entered</br> till date</p>
        </div>
        <div class="col-sm-2">
            <h1>7k</h1>
            <p class="mt-10">Pros still in</br> the campaign</p>
        </div>
        <div class="col-sm-2">
            <h1>13k</h1>
            <p class="mt-10">Pros who left</br> the campaign</p>
        </div>
        <div class="col-sm-2">
            <h1>65%</h1>
            <p class="mt-10">Pros who left</br> the campaign</p>
        </div>
        <div class="col-sm-2">
            <h1>2k</h1>
            <p class="mt-10">Pros successfully completed</br> the campaign</p>
        </div>
        <div class="col-sm-2">
            <h1>10%</h1>
            <p class="mt-10">Pros successfully completed</br> the campaign</p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">
            <h1>12k</h1>
            <p class="mt-10">Pros failed the</br> campaign</p>
        </div>
        <div class="col-sm-2">
            <h1>60%</h1>
            <p class="mt-10">Pros failed the</br> campaign</p>
        </div>
        <div class="col-sm-2">
            <h1>900</h1>
            <p class="mt-10">Pros unsubscribed the</br> campaign</p>
        </div>
        <div class="col-sm-2">
            <h1>9%</h1>
            <p class="mt-10">Pros unsubscribed the</br> campaign</p>
        </div>
    </div>
</div>
<!-- <hr> -->
<div style="padding: 10px 20px; text-align: center;">
    <div class="row">
        <div class="col-sm-2">
            <h1>20k</h1>
            <p class="text-muted">-- </p>
            <p class="mt-10">Total Pros entered</br> till date</p>
        </div>
        <div class="col-sm-2">
            <h1>7k</h1>
            <p class="text-muted">or 35% </p>
            <p class="mt-10">Pros still in</br> the campaign</p>
        </div>
        <div class="col-sm-2">
            <h1>13k</h1>
            <p class="text-muted">or 65% </p>
            <p class="mt-10">Pros who left</br> the campaign</p>
        </div>
        <div class="col-sm-2">
            <h1>2k</h1>
            <p class="text-muted">or 10% </p>
            <p class="mt-10">Pros successfully completed</br> the campaign</p>
        </div>
        <div class="col-sm-2">
            <h1>12k</h1>
            <p class="text-muted">or 60% </p>
            <p class="mt-10">Pros failed the</br> campaign</p>
        </div>
        <div class="col-sm-2">
            <h1>900</h1>
            <p class="text-muted">or 9% </p>
            <p class="mt-10">Pros unsubscribed the</br> campaign</p>
        </div>
    </div>
    <div class="row">
    </div>
</div>
<hr>
<div class="row pt-md pr-md pb-md pl-md">
    <div class="col-sm-6">
        <table class="table table-hover table-striped table-bordered">
            <thead>
                <tr>
                    <th class="visible-md visible-lg col-campaign-category">No.
                    </th>
                    <th class="col-campaign-name">
                        <div class="thead-filter">
                            <a href="javascript: void(0);">
                                <span>Success Events</span>
                            </a>
                        </div>
                    </th>
                    <th class="visible-md visible-lg col-campaign-category">Count
                    </th>
                    <th class="visible-md visible-lg col-campaign-category">Percentage
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="visible-md visible-lg">
                        1.
                    </td>
                    <td>
                        <div>
                            <a href="/v443/s/campaigns/view/1" data-toggle="ajax">
                                Step 1 </a>
                        </div>
                    </td>
                    <td class="visible-md visible-lg">
                        100
                    </td>
                    <td class="visible-lg">
                        10% </td>
                </tr>
                <tr>
                    <td class="visible-md visible-lg">
                        2.
                    </td>
                    <td>
                        <div>
                            <a href="/v443/s/campaigns/view/1" data-toggle="ajax">
                                After email 2 </a>
                        </div>
                    </td>
                    <td class="visible-md visible-lg">
                        100
                    </td>
                    <td class="visible-lg">
                        10% </td>
                </tr>
                <tr>
                    <td class="visible-md visible-lg">
                        3.
                    </td>
                    <td>
                        <div>
                            <a href="/v443/s/campaigns/view/1" data-toggle="ajax">
                                Before language condition </a>
                        </div>
                    </td>
                    <td class="visible-md visible-lg">
                        50
                    </td>
                    <td class="visible-lg">
                        12.5% </td>
                </tr>
                <tr>
                    <td class="visible-md visible-lg">
                        4.
                    </td>
                    <td>
                        <div>
                            <a href="/v443/s/campaigns/view/1" data-toggle="ajax">
                                After subscription check </a>
                        </div>
                    </td>
                    <td class="visible-md visible-lg">
                        250
                    </td>
                    <td class="visible-lg">
                        62.5% </td>
                </tr>
                <tr>
                    <td class="visible-md visible-lg">
                        5.
                    </td>
                    <td>
                        <div>
                            <a href="/v443/s/campaigns/view/1" data-toggle="ajax">
                                Step 5 </a>
                        </div>
                    </td>
                    <td class="visible-md visible-lg">
                        10
                    </td>
                    <td class="visible-lg">
                        5% </td>
                </tr>
            </tbody>
        </table>
    </div>


    <div class="col-sm-6">
        <table class="table table-hover table-striped table-bordered">
            <thead>
                <tr>
                    <th class="visible-md visible-lg col-campaign-category">No.
                    </th>
                    <th class="col-campaign-name">
                        <div class="thead-filter">
                            <a href="javascript: void(0);">
                                <span>Failed Events</span>
                            </a>
                        </div>
                    </th>
                    <th class="visible-md visible-lg col-campaign-category">Count
                    </th>
                    <th class="visible-md visible-lg col-campaign-category">Percentage
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="visible-md visible-lg">
                        1.
                    </td>
                    <td>
                        <div>
                            <a href="/v443/s/campaigns/view/1" data-toggle="ajax">
                                Step 1 </a>
                        </div>
                    </td>
                    <td class="visible-md visible-lg">
                        100
                    </td>
                    <td class="visible-lg">
                        10% </td>
                </tr>
                <tr>
                    <td class="visible-md visible-lg">
                        2.
                    </td>
                    <td>
                        <div>
                            <a href="/v443/s/campaigns/view/1" data-toggle="ajax">
                                Step 2 </a>
                        </div>
                    </td>
                    <td class="visible-md visible-lg">
                        100
                    </td>
                    <td class="visible-lg">
                        10% </td>
                </tr>
                <tr>
                    <td class="visible-md visible-lg">
                        3.
                    </td>
                    <td>
                        <div>
                            <a href="/v443/s/campaigns/view/1" data-toggle="ajax">
                                Step 3 </a>
                        </div>
                    </td>
                    <td class="visible-md visible-lg">
                        50
                    </td>
                    <td class="visible-lg">
                        12.5% </td>
                </tr>
                <tr>
                    <td class="visible-md visible-lg">
                        4.
                    </td>
                    <td>
                        <div>
                            <a href="/v443/s/campaigns/view/1" data-toggle="ajax">
                                Step 4 </a>
                        </div>
                    </td>
                    <td class="visible-md visible-lg">
                        250
                    </td>
                    <td class="visible-lg">
                        62.5% </td>
                </tr>
                <tr>
                    <td class="visible-md visible-lg">
                        5.
                    </td>
                    <td>
                        <div>
                            <a href="/v443/s/campaigns/view/1" data-toggle="ajax">
                                Step 5 </a>
                        </div>
                    </td>
                    <td class="visible-md visible-lg">
                        10
                    </td>
                    <td class="visible-lg">
                        5% </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>