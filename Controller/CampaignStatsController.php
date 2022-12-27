<?php

/*
 * @copyright   2019 Mautic Contributors. All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\SosCampaignStatsBundle\Controller;

use Mautic\CoreBundle\Controller\AbstractStandardFormController;
use Mautic\PluginBundle\Helper\IntegrationHelper;
use Symfony\Component\HttpFoundation\JsonResponse;

class CampaignStatsController extends AbstractStandardFormController
{

    /**
     * {@inheritdoc}
     */
    protected function getJsLoadMethodPrefix()
    {
        return 'campaign-stats';
    }

    /**
     * {@inheritdoc}
     */
    protected function getModelName()
    {
        return 'campaign';
    }

    /**
     * {@inheritdoc}
     */
    protected function getRouteBase()
    {
        return 'campaign';
    }

    /***
     * @param null $objectId
     *
     * @return string
     */
    protected function getSessionBase($objectId = null)
    {
        return 'CampaignStats' . (($objectId) ? '.' . $objectId : '');
    }

    /**
     * @return string
     */
    protected function getControllerBase()
    {
        return 'SosCampaignStatsBundle:CampaignStats';
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function batchDeleteAction()
    {
        return $this->batchDeleteStandard();
    }

    /**
     * @param $objectId
     *
     * @return \Mautic\CoreBundle\Controller\Response|\Symfony\Component\HttpFoundation\JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function cloneAction($objectId)
    {
        return $this->cloneStandard($objectId);
    }

    /**
     * @param      $objectId
     * @param bool $ignorePost
     *
     * @return \Mautic\CoreBundle\Controller\Response|\Symfony\Component\HttpFoundation\JsonResponse
     */
    public function editAction($objectId, $ignorePost = false)
    {
        return $this->editStandard($objectId, $ignorePost);
    }

    /**
     * @param int $page
     *
     * @return \Mautic\CoreBundle\Controller\Response|\Symfony\Component\HttpFoundation\JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function index2Action($page = null)
    {
        //set some permissions
        $permissions = $this->get('mautic.security')->isGranted(
            [
                'campaign:campaigns:view',
                'campaign:campaigns:viewown',
                'campaign:campaigns:viewother',
                'campaign:campaigns:create',
                'campaign:campaigns:edit',
                'campaign:campaigns:editown',
                'campaign:campaigns:editother',
                'campaign:campaigns:delete',
                'campaign:campaigns:deleteown',
                'campaign:campaigns:deleteother',
                'campaign:campaigns:publish',
                'campaign:campaigns:publishown',
                'campaign:campaigns:publishother',
            ],
            'RETURN_ARRAY',
            null,
            true
        );

        if (!$permissions['campaign:campaigns:view']) {
            return $this->accessDenied();
        }

        $this->setListFilters();

        $session = $this->get('session');
        if (empty($page)) {
            $page = $session->get('mautic.campaign.page', 1);
        }

        //set limits
        $limit = $session->get('mautic.campaign.limit', $this->coreParametersHelper->get('default_pagelimit'));
        $start = (1 === $page) ? 0 : (($page - 1) * $limit);
        if ($start < 0) {
            $start = 0;
        }

        $search = $this->request->get('search', $session->get('mautic.campaign.filter', ''));
        $session->set('mautic.campaign.filter', $search);

        $filter = ['string' => $search, 'force' => []];

        $model = $this->getModel('campaign');

        if (!$permissions[$this->getPermissionBase() . ':viewother']) {
            $filter['force'][] = ['column' => 'c.createdBy', 'expr' => 'eq', 'value' => $this->user->getId()];
        }

        $orderBy    = $session->get('mautic.campaign.orderby', 'c.dateModified');
        $orderByDir = $session->get('mautic.campaign.orderbydir', $this->getDefaultOrderDirection());

        [$count, $items] = $this->getIndexItems($start, $limit, $filter, $orderBy, $orderByDir);

        if ($count && $count < ($start + 1)) {
            //the number of entities are now less then the current page so redirect to the last page
            $lastPage = (1 === $count) ? 1 : (((ceil($count / $limit)) ?: 1) ?: 1);

            $session->set('mautic.campaign.page', $lastPage);
            $returnUrl = $this->generateUrl('mautic_campaign_index', ['page' => $lastPage]);

            return $this->postActionRedirect(
                $this->getPostActionRedirectArguments(
                    [
                        'returnUrl'       => $returnUrl,
                        'viewParameters'  => ['page' => $lastPage],
                        'contentTemplate' => 'SosCampaignStatsBundle:CampaignStats:index',
                        'passthroughVars' => [
                            'mauticContent' => 'campaign',
                        ],
                    ],
                    'index'
                )
            );
        }

        //set what page currently on so that we can return here after form submission/cancellation
        $session->set('mautic.campaign.page', $page);

        $viewParameters = [
            'permissionBase'  => $this->getPermissionBase(),
            'mauticContent'   => $this->getJsLoadMethodPrefix(),
            'sessionVar'      => $this->getSessionBase(),
            'actionRoute'     => $this->getActionRoute(),
            'indexRoute'      => $this->getIndexRoute(),
            'tablePrefix'     => $model->getRepository()->getTableAlias(),
            'modelName'       => $this->getModelName(),
            'translationBase' => $this->getTranslationBase(),
            'searchValue'     => $search,
            'items'           => $items,
            'totalItems'      => $count,
            'page'            => $page,
            'limit'           => $limit,
            'permissions'     => $permissions,
            'tmpl'            => $this->request->get('tmpl', 'index'),
        ];

        //echo $this->getTemplateName('list.html.php');
        return $this->delegateView(
            $this->getViewArguments(
                [
                    'viewParameters'  => $viewParameters,
                    'contentTemplate' => 'SosCampaignStatsBundle:CampaignStats:index.html.php',
                    'passthroughVars' => [
                        'mauticContent' => $this->getJsLoadMethodPrefix(),
                        'route'         => $this->generateUrl($this->getIndexRoute(), ['page' => $page]),
                    ],
                ],
                'index'
            )
        );
    }

    public function indexAction()
    {
        return $this->delegateView(
            [
                'contentTemplate' => 'SosCampaignStatsBundle:CampaignStats:list.html.php',
            ]
        );
    }

    /**
     * @return \Mautic\CoreBundle\Controller\Response|\Symfony\Component\HttpFoundation\JsonResponse
     */
    public function newAction()
    {
        return $this->newStandard();
    }

    public function singleStatAction()
    {
        return $this->delegateView(
            [
                'contentTemplate' => 'SosCampaignStatsBundle:CampaignStats:single.html.php',
            ]
        );
    }

    /**
     * @param $objectId
     *
     * @return array|\Symfony\Component\HttpFoundation\JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($objectId)
    {
        return $this->viewStandard($objectId, $this->getModelName(), null, null, 'entity');
    }

    /**
     * @param $args
     * @param $action
     *
     * @return mixed
     */
    protected function getViewArguments(array $args, $action)
    {
        $viewParameters = [];
        switch ($action) {
            case 'new':
            case 'edit':
                break;
            case 'view':
                break;
        }
        $args['viewParameters'] = array_merge($args['viewParameters'], $viewParameters);

        return $args;
    }


    /**
     * @param $objectId
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function deleteAction($objectId)
    {
        return $this->deleteStandard($objectId);
    }

    protected function getDefaultOrderColumn()
    {
        return 'id';
    }


    /**
     * @param int $objectId
     *
     * @return JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function batchCronsAction($objectId = 0)
    {
        /** @var \Mautic\LeadBundle\Model\LeadModel $model */
        $model = $this->getModel('sqlConditions');
        /** @var IntegrationHelper $integrationHelper */
        $integrationHelper = $this->get('mautic.helper.integration');
        $integration = $integrationHelper->getIntegrationObject('SqlConditions');

        if (false === $integration || !$integration->getIntegrationSettings()->getIsPublished()) {
            return;
        }
        $settings = $integration->mergeConfigToFeatureSettings();
        $ids  = $this->request->get('ids');
        $entities = $model->getEntities(
            [
                'filter'           => [
                    'force' => [
                        [
                            'column' => 'e.id',
                            'expr'   => 'in',
                            'value'  => $ids,
                        ],
                    ],
                ],
                'ignore_paginator' => true,
            ]
        );
        return $this->delegateView(
            [
                'viewParameters'  => [
                    'entities' => $entities,
                    'crons' => $settings['crons'],
                    'pathsHelper' => $this->get('mautic.helper.paths'),
                ],
                'contentTemplate' => 'SosCampaignStatsBundle:Batch:crons.html.php',
            ]
        );
    }


    /**
     * @param array $args
     * @param       $action
     *
     * @return array
     */
    protected function getPostActionRedirectArguments(array $args, $action)
    {
        $updateSelect = ($this->request->getMethod() == 'POST')
            ? $this->request->request->get('sqlConditions[updateSelect]', false, true)
            : $this->request->get(
                'updateSelect',
                false
            );
        if ($updateSelect) {
            switch ($action) {
                case 'new':
                case 'edit':
                    $passthrough = $args['passthroughVars'];
                    $passthrough = array_merge(
                        $passthrough,
                        [
                            'updateSelect' => $updateSelect,
                            'id'           => $args['entity']->getId(),
                            'name'         => $args['entity']->getName(),
                        ]
                    );
                    $args['passthroughVars'] = $passthrough;
                    break;
            }
        }

        return $args;
    }

    /**
     * @return array
     */
    protected function getEntityFormOptions()
    {
        $updateSelect = ($this->request->getMethod() == 'POST')
            ? $this->request->request->get('sqlConditions[updateSelect]', false, true)
            : $this->request->get(
                'updateSelect',
                false
            );
        if ($updateSelect) {
            return ['update_select' => $updateSelect];
        }
    }

    /**
     * Return array of options update select response.
     *
     * @param string $updateSelect HTML id of the select
     * @param object $entity
     * @param string $nameMethod   name of the entity method holding the name
     * @param string $groupMethod  name of the entity method holding the select group
     *
     * @return array
     */
    protected function getUpdateSelectParams($updateSelect, $entity, $nameMethod = 'getName', $groupMethod = 'getLanguage')
    {
        $options = [
            'updateSelect' => $updateSelect,
            'id'           => $entity->getId(),
            'name'         => $entity->$nameMethod(),
        ];

        return $options;
    }
}
