<?php

/*
 * @copyright   2019 Mautic Contributors. All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\SosCampaignStatsBundle;

final class CampaignStatsEvents
{
    const ON_CAMPAIGN_CONDITION_TRIGGER = 'mautic.SosCampaignStats.on_campaign_condition_trigger';

    const ON_CAMPAIGN_MARK_SUCCESS = 'mautic.SosCampaignStats.on_campaign_mark_success';

    const ON_CAMPAIGN_MARK_FAILED = 'mautic.SosCampaignStats.on_campaign_mark_failed';
}
