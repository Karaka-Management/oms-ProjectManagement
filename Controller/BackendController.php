<?php
/**
 * Karaka
 *
 * PHP Version 8.1
 *
 * @package   Modules\ProjectManagement
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\ProjectManagement\Controller;

use Modules\ProjectManagement\Models\ProjectMapper;
use phpOMS\Asset\AssetType;
use phpOMS\Contract\RenderableInterface;
use phpOMS\DataStorage\Database\Query\OrderType;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Views\View;

/**
 * Event Management controller class.
 *
 * @package Modules\ProjectManagement
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 * @codeCoverageIgnore
 */
final class BackendController extends Controller
{
    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewProjectManagementList(RequestAbstract $request, ResponseAbstract $response, mixed $data = null) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/ProjectManagement/Theme/Backend/projectmanagement-list');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1001701001, $request, $response);

        $projects               = ProjectMapper::getAll()->sort('id', OrderType::DESC)->limit(25);
        $view->data['projects'] = $projects;

        return $view;
    }

    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewProjectManagementCreate(RequestAbstract $request, ResponseAbstract $response, mixed $data = null) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/ProjectManagement/Theme/Backend/projectmanagement-create');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1001701001, $request, $response);

        return $view;
    }

    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewProjectManagementProfile(RequestAbstract $request, ResponseAbstract $response, mixed $data = null) : RenderableInterface
    {
        /** @var \phpOMS\Model\Html\Head $head */
        $head = $response->get('Content')->head;
        $head->addAsset(AssetType::CSS, '/Modules/Calendar/Theme/Backend/css/styles.css?v=1.0.0');

        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/ProjectManagement/Theme/Backend/projectmanagement-profile');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1001701001, $request, $response);

        $taskListView = new \Modules\Tasks\Theme\Backend\Components\Tasks\ListView($this->app->l11nManager, $request, $response);
        $taskListView->setTemplate('/Modules/Tasks/Theme/Backend/Components/Tasks/list');
        $view->data['tasklist'] = $taskListView;

        $calendarView = new \Modules\Calendar\Theme\Backend\Components\Calendar\BaseView($this->app->l11nManager, $request, $response);
        $calendarView->setTemplate('/Modules/Calendar/Theme/Backend/Components/Calendar/mini');
        $view->data['calendar'] = $calendarView;

        $mediaListView = new \Modules\Media\Views\MediaView($this->app->l11nManager, $request, $response);
        $mediaListView->setTemplate('/Modules/Media/Theme/Backend/Components/Media/list');
        $view->data['medialist'] = $mediaListView;

        $project               = ProjectMapper::get()->where('id', (int) $request->getData('id'))->execute();
        $view->data['project'] = $project;

        return $view;
    }
}
