<?php

/*
 * @copyright   2019 Mautic Contributors. All rights reserved
 * @author      MTCExtendee.com, Inc.
 *
 * @link        https://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\SosCampaignStatsBundle\EventListener;

use Mautic\CoreBundle\CoreEvents;
use Mautic\CoreBundle\Event\CustomButtonEvent;
use Mautic\CoreBundle\Templating\Helper\ButtonHelper;
use Mautic\EmailBundle\Entity\Email;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Router;
use Symfony\Component\Translation\TranslatorInterface;

class ButtonSubscriber implements EventSubscriberInterface
{
    protected $integrationHelper;

    private $event;

    private $objectId;

    private $translator;

    private $router;

    /**
     * ButtonSubscriber constructor.
     */
    public function __construct(TranslatorInterface $translator, Router $router)
    {
        $this->translator        = $translator;
        $this->router            = $router;
    }

    public static function getSubscribedEvents()
    {
        return [
            CoreEvents::VIEW_INJECT_CUSTOM_BUTTONS => ['injectViewButtons', 0],
        ];
    }

    public function injectViewButtons(CustomButtonEvent $event)
    {
        //dd($event);
        $this->injectCronTesterButtons($event);
    }

    private function injectCronTesterButtons(CustomButtonEvent $event)
    {
        $objectId = $event->getRequest()->get('objectId');
        $this->setEvent($event);
        $this->setObjectId($objectId);
        if (null != $event->getItem()) {
            /** @var Email $object */
            $object = $event->getItem();
            if (method_exists($object, 'getEmailType') && 'list' != $object->getEmailType()) {
                return;
            }
            if (method_exists($object, 'getId')) {
                $this->setObjectId($event->getItem()->getId());
            }
        }

        $buttons = [
            // [
            //     'objectAction' => 'segmentRebuild',
            //     'label'        => 'mautic.crontester.rebuild.segment',
            //     'icon'         => 'fa fa-refresh',
            //     'context'      => 'segment',
            // ],
            // [
            //     'objectAction' => 'campaignRebuild',
            //     'label'        => 'mautic.crontester.rebuild.campaign',
            //     'icon'         => 'fa fa-refresh',
            //     'context'      => 'campaign',
            // ],
            // [
            //     'objectAction' => 'campaignTrigger',
            //     'label'        => 'mautic.crontester.trigger.campaign',
            //     'icon'         => 'fa fa-play',
            //     'context'      => 'campaign',
            // ],
            [
                //'objectAction' => 'campaignTrigger',
                'label'        => 'View Stats',
                'icon'         => 'fa fa-line-chart',
                'context'      => 'campaign',
            ],
        ];

        foreach ($buttons as $button) {
            $this->addButtonGenerator($button['objectAction'], $button['label'], $button['icon'], $button['context']);
        }
    }

    /**
     * @param        $objectAction
     * @param        $btnText
     * @param        $icon
     * @param        $context
     * @param int    $priority
     * @param null   $target
     * @param string $header
     */
    private function addButtonGenerator($objectAction, $btnText, $icon, $context, $priority = 1, $target = null, $header = '')
    {
        $event    = $this->getEvent();
        $objectId = $this->getObjectId();

        $route    = $this->router->generate(
            'mautic_campaign_stats_single',
            [
                'objectAction' => $objectAction,
                'objectId'     => $objectId,
            ]
        );

        $attr     = [
            'href'        => $route,
            'data-toggle' => 'ajax',
            'data-method' => 'POST',
        ];

        switch ($target) {
            case '_blank':
                $attr['data-toggle'] = '';
                $attr['data-method'] = '';
                $attr['target']      = $target;
                break;
            case '#MauticSharedModal':
                $attr['data-toggle'] = 'ajaxmodal';
                $attr['data-method'] = '';
                $attr['data-target'] = $target;
                $attr['data-header'] = $header;
                break;
        }

        $button =
            [
                'attr'      => $attr,
                'btnText'   => $this->translator->trans($btnText),
                'iconClass' => $icon,
                'priority'  => $priority,
            ];

        $event
            ->addButton(
                $button,
                ButtonHelper::LOCATION_PAGE_ACTIONS,
                ['mautic_' . $context . '_action', ['objectAction' => 'view'],]
            );
    }

    /**
     * @return mixed
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param mixed $event
     */
    public function setEvent($event)
    {
        $this->event = $event;
    }

    /**
     * @return mixed
     */
    public function getObjectId()
    {
        return $this->objectId;
    }

    /**
     * @param mixed $objectId
     */
    public function setObjectId($objectId)
    {
        $this->objectId = $objectId;
    }
}
