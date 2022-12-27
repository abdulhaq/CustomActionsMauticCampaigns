<?php

/*
 * @copyright   2019 Mautic Contributors. All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\SosCampaignStatsBundle\Executioner;

use Mautic\CampaignBundle\Event\ConditionEvent;

class CampaignStatsExecutioner
{
    /**
     * @var SqlConditionDetails
     */
    private $CampaignStatsDetails;

    /**
     * @var QueryBuilder
     */
    private $queryBuilder;

    /**
     * SqlExecutioner constructor.
     *
     * @param SqlConditionDetails $sqlConditionDetails
     * @param QueryBuilder        $queryBuilder
     */
    public function __construct()
    {
        //$this->CampaignStatsDetails = $CampaignStatsDetails;
    }

    /**
     * @param ConditionEvent $conditionEvent
     *
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     */
    public function execute(ConditionEvent $conditionEvent)
    {
        $this->CampaignStatsDetails->setConditionEvent($conditionEvent);
        //return $this->queryBuilder->runQuery($this->CampaignStatsDetails);
    }
}
