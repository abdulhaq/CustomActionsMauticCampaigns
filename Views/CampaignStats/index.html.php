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
$view->extend('MauticCoreBundle:Standard:list.html.php');

//$view['slots']->set('mauticContent', 'sqlConditions');
$view['slots']->set('headerTitle', 'Campaign Stats');
?>
<script>
    alert('sdd');
    // jQuery('.CampaignStats-list a').each(function() {
    //     jQuery(this).attr("href", '/v441/s/campaign-stats/view/1');
    // });
</script>
<?php
// $view['slots']->set(
//     'actions',
//     $view->render(
//         'MauticCoreBundle:Helper:page_actions.html.php',
//         [
//             'routeBase' => 'campaign-stats',
//         ]
//     )
// );
?>