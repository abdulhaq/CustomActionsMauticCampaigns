<?php

/*
 * @copyright   2016 Mautic Contributors. All rights reserved
 * @author      Mautic, Inc.
 *
 * @link        https://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\SosCampaignStatsBundle\EventListener;

use Mautic\CampaignBundle\CampaignEvents;
use Mautic\CampaignBundle\Event\CampaignBuilderEvent;
use Mautic\CampaignBundle\Event\ConditionEvent;
use Mautic\CampaignBundle\Event\CampaignExecutionEvent;
use MauticPlugin\SosCampaignStatsBundle\Executioner\CampaignStatsExecutioner;
use MauticPlugin\SosCampaignStatsBundle\CampaignStatsEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class CampaignStatsSubscriber.
 */
class CampaignStatsSubscriber implements EventSubscriberInterface
{

    /**
     * @var SqlExecutioner
     */
    private $CampaignStatsDetails;

    /**
     * CampaignConditionSubscriber constructor.
     *
     * @param SqlExecutioner $sqlExecutioner
     */
    public function __construct()
    {
        //$this->CampaignStatsDetails = $CampaignStatsDetails;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            CampaignEvents::CAMPAIGN_ON_BUILD                  => ['onCampaignBuild', 0],
            CampaignStatsEvents::ON_CAMPAIGN_MARK_SUCCESS => ['onCampaignMarkSuccess', 0],
            CampaignStatsEvents::ON_CAMPAIGN_MARK_FAILED => ['onCampaignMarkFailed', 0]
        ];
    }

    /**
     * @param CampaignBuilderEvent $event
     */
    public function onCampaignBuild(CampaignBuilderEvent $event)
    {
        $event->addAction(
            'sos.campaign.mark_success',
            [
                'label'           => 'Mark as Success',
                'eventName'       => CampaignStatsEvents::ON_CAMPAIGN_MARK_SUCCESS, 'description'     => 'Mark campaign as success for this contact',

            ]
        );

        $event->addAction(
            'sos.campaign.mark_failed',
            [
                'label'           => 'Mark as Failed',
                'eventName'       => CampaignStatsEvents::ON_CAMPAIGN_MARK_FAILED, 'description'     => 'Mark campaign as failed for this contact',
            ]
        );
    }

    public function onCampaignMarkSuccess(CampaignExecutionEvent $event)
    {
        $myfile = fopen("newfile11.txt", "a+") or die("Unable to open file!");
        //$eventStr = serialize($event->email);
        $eventStr = serialize($event->getEventDetails());
        fwrite($myfile, $eventStr . ' onCampaignMarkSuccess');
        fclose($myfile);
        $event->setResult(true);

        // - id, event_id, campaign_id, count
    }

    public function onCampaignMarkFailed(CampaignExecutionEvent $event)
    {
        $myfile = fopen("newfile11.txt", "a+") or die("Unable to open file!");
        //$eventStr = serialize($event->email);
        $eventStr = serialize($event->getEventDetails());
        fwrite($myfile, $eventStr . ' onCampaignMarkFailed');
        fclose($myfile);
        $event->setResult(true);
    }
}
