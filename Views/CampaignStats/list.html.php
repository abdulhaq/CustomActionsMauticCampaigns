<script>
    //alert('sdd');
    // jQuery('.CampaignStats-list a').each(function() {
    //     jQuery(this).attr("href", '/v441/s/campaign-stats/view/1');
    // });
</script>
<?php

/*
 * @copyright   2019 Mautic Contributors. All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
//$view->extend('MauticCoreBundle:Default:content.html.php');
$view->extend('MauticCoreBundle:Standard:index.html.php');

$view['slots']->set('headerTitle', 'Campaign Stats');
?>
<table class="table table-hover table-striped table-bordered">
    <thead>
        <tr>
            <th class="visible-md visible-lg col-campaign-category">ID
            </th>
            <th class="col-campaign-name">
                <div class="thead-filter">
                    <a href="javascript: void(0);">
                        <span>Campaign Name</span>
                    </a>
                </div>
            </th>
            <th class="visible-md visible-lg col-campaign-category">Pros Enter
            </th>
            <th class="visible-md visible-lg col-campaign-category">Pros Exit
            </th>
            <th class="visible-md visible-lg col-campaign-category">Pros Exit %
            </th>
            <th class="visible-md visible-lg col-campaign-category">Success
            </th>
            <th class="visible-md visible-lg col-campaign-category">Success %
            </th>
            <th class="visible-md visible-lg col-campaign-category">Failed
            </th>
            <th class="visible-md visible-lg col-campaign-category">Failed %
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
                    <a href="view/1" data-toggle="ajax">
                        Test Campaign </a>
                </div>
            </td>
            <td class="visible-md visible-lg">
                20k
            </td>
            <td class="visible-lg">
                13k </td>
            <td class="visible-lg">
                65% </td>
            <td class="visible-lg">
                2.5k </td>
            <td class="visible-lg">
                12.5% </td>
            <td class="visible-lg">
                6k </td>
            <td class="visible-lg">
                30% </td>
        </tr>
        <tr>
            <td class="visible-md visible-lg">2
            </td>
            <td>
                <div>
                    <a href="/v443/s/campaigns/view/1" data-toggle="ajax">
                        Another Campaign </a>
                </div>
            </td>
            <td class="visible-md visible-lg">
                20k
            </td>
            <td class="visible-lg">
                13k </td>
            <td class="visible-lg">
                65% </td>
            <td class="visible-lg">
                2.5k </td>
            <td class="visible-lg">
                12.5% </td>
            <td class="visible-lg">
                6k </td>
            <td class="visible-lg">
                30% </td>
        </tr>
    </tbody>
</table>
<style>
    .table>tbody>tr>td,
    .table>tfoot>tr>td {
        padding: 15px 15px;
    }

    .table>thead>tr>th {
        padding: 12px 15px;
    }
</style>