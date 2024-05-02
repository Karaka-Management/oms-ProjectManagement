<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\ProjectManagement
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\ProjectManagement\Controller;

use Modules\ProjectManagement\Models\NullProject;
use Modules\ProjectManagement\Models\ProgressType;
use Modules\ProjectManagement\Models\ProjectMapper;
use phpOMS\Asset\AssetType;
use phpOMS\Contract\RenderableInterface;
use phpOMS\DataStorage\Database\Query\Builder;
use phpOMS\DataStorage\Database\Query\OrderType;
use phpOMS\Math\Number\Numbers;
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
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @feature Create Gantt chart for all active projects in one overview
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewProjectManagementList(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/ProjectManagement/Theme/Backend/projectmanagement-list');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1001701001, $request, $response);

        $view->data['projects'] = ProjectMapper::getAll()
            ->sort('id', OrderType::DESC)
            ->limit(25)
            ->executeGetArray();

        // Evaluate progress
        $view->data['progress'] = [];

        $taskProgress = [];

        $now = new \DateTime('now');

        /** @var \Modules\ProjectManagement\Models\Project $project */
        foreach ($view->data['projects'] as $project) {
            if ($project->progressType === ProgressType::TASKS) {
                $taskProgress[] = $project->id;
            } elseif ($project->progressType === ProgressType::LINEAR) {
                $duration = (int) $project->start->diff($project->endEstimated)->format('%a');
                $progress = (int) $project->start->diff($now)->format('%a');

                $view->data['progress'][$project->id] = (int) \min(100, $duration / $progress * 100);
            } elseif ($project->progressType === ProgressType::EXPONENTIAL) {
                $duration = (int) $project->start->diff($project->endEstimated)->format('%a');
                $progress = (int) $project->start->diff($now)->format('%a');

                $view->data['progress'][$project->id] = (int) Numbers::remapRangeExponentially($progress, $duration);
            } elseif ($project->progressType === ProgressType::LOG) {
                $duration = (int) $project->start->diff($project->endEstimated)->format('%a');
                $progress = (int) $project->start->diff($now)->format('%a');

                $view->data['progress'][$project->id] = (int) Numbers::remapRangeLog($progress, $duration);
            } else {
                $view->data['progress'][$project->id] = $project->progress;
            }
        }

        // Count tasks per project where tasks are used as progress indication
        $projectIds = \implode(',', $taskProgress);

        $sql = <<<SQL
        SELECT projectmanagement_task_relation_dst as id,
            COUNT(projectmanagement_task_relation_src) as total_tasks,
            SUM(task.task_status = 1 OR task.task_status = 2) AS open_tasks
        FROM projectmanagement_task_relation
        LEFT JOIN task ON projectmanagement_task_relation.projectmanagement_task_relation_src = task.task_id
        WHERE projectmanagement_task_relation_dst IN ({$projectIds});
        SQL;

        $query   = new Builder($this->app->dbPool->get());
        $results = $query->raw($sql)->execute()?->fetchAll(\PDO::FETCH_ASSOC) ?? [];
        foreach ($results as $result) {
            $view->data['progress'][$result['id']] = (int) (($result['total_tasks'] - $result['open_tasks']) / $result['total_tasks']);
        }

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewProjectManagementCreate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/ProjectManagement/Theme/Backend/projectmanagement-view');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1001701001, $request, $response);

        $view->data['project'] = new NullProject();

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @feature Create Gantt chart for project based on milestones and tasks and general project settings
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewProjectManagementView(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        /** @var \phpOMS\Model\Html\Head $head */
        $head = $response->data['Content']->head;
        $head->addAsset(AssetType::CSS, '/Modules/Calendar/Theme/Backend/css/styles.css?v=' . self::VERSION);

        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/ProjectManagement/Theme/Backend/projectmanagement-view');
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
