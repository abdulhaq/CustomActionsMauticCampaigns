<?php

/*
 * @copyright   2014 Mautic Contributors. All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

return [
    'name'        => 'SoS Campaign Stats',
    'description' => 'Evaluate success or fail ratio of campaigns',
    'version'     => '1.0',
    'author'      => 'Star Of Service',
    'services'    => [
        'events'  => [
            'mautic.sosCampaignStats.campaign.condition.subscriber' => [
                'class'     => \MauticPlugin\SosCampaignStatsBundle\EventListener\CampaignStatsSubscriber::class,
            ],
            'mautic.sosCampaignStats.button.subscriber' => [
                'class'     => \MauticPlugin\SosCampaignStatsBundle\EventListener\ButtonSubscriber::class,
                'arguments' => [
                    'translator',
                    'router',
                ],
            ],
        ],
    ],
    'routes'      => [
        'main' => [
            'mautic_campaign_stats_list'  => [
                'path'       => '/campaign-stats/{page}',
                'controller' => 'SosCampaignStatsBundle:CampaignStats:index',
            ],
            'mautic_campaign_stats_single'  => [
                'path'       => '/campaign-stats/{objectAction}/{objectId}',
                'controller' => 'SosCampaignStatsBundle:CampaignStats:singleStat',
            ],
        ],
    ],
    'menu' => [
        'main' => [
            // 'items' => [
            //     'Campaign Stats' => [
            //         'route'    => 'mautic_campaign_stats_list',
            //         'id' => 'demo_menu',
            //         'priority' => 48,
            //         'iconClass' => 'fa fa-line-chart'
            //     ]
            // ]
        ]
    ],
];
