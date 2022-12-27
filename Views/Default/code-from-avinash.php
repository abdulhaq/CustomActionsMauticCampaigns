<?php

namespace MauticPlugin\VegaWayExample\EventListener;

use Mautic\CoreBundle\CoreEvents;
use Mautic\CoreBundle\Event\CustomTemplateEvent;
use Mautic\CoreBundle\Helper\TemplatingHelper;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ReplaceTemplateSubscriber implements EventSubscriberInterface
{
    private $templateHelper;

    public function __construct(TemplatingHelper $templateHelper) {
        $this->templateHelper = $templateHelper;
    }

    public static function getSubscribedEvents()
    {
        return [
            CoreEvents::VIEW_INJECT_CUSTOM_TEMPLATE => [
                ['replaceTemplate', 0],
            ],
        ];
    }

    public function replaceTemplate(CustomTemplateEvent $event)
    {
        if ('MauticCoreBundle:LeftPanel:index.html.php' == $event->getTemplate()) {
            $event->setTemplate('VegaWayExampleBundle:Core/LeftPanel:index.html.php');
        } elseif ('MauticUserBundle:Security:base.html.php' == $event->getTemplate()) {
            $event->setTemplate('VegaWayExampleBundle:User/Security:base.html.php');
        } elseif ('MauticUserBundle:Security:ajax.html.php' == $event->getTemplate()) {
            $event->setTemplate('VegaWayExampleBundle:User/Security:ajax.html.php');
    }
}
This is a subscriber you use in a custom plugin that will replace the template.
On the filesystem you create template files. For example in first case
VegaWayExampleBundle:Core/LeftPanel:index.html.php
This template should be located in:
VegaWayExampleBundle/Views/Core/LeftPanel/index.html.php
Do not forget to put declaration of subscriber class into your Config/config.php file.

You can hook into REPLACE_TEMPLATE and INJECT_CUSTOM_CONTENT events look into core source to see how its done