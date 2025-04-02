<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\ProjectManagement
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.2
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\ProjectManagement\Controller;

use Modules\Admin\Models\NullAccount;
use Modules\Media\Models\NullMedia;
use Modules\ProjectManagement\Models\ProgressType;
use Modules\ProjectManagement\Models\Project;
use Modules\ProjectManagement\Models\ProjectMapper;
use phpOMS\Message\Http\RequestStatusCode;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Utils\Parser\Markdown\Markdown;

/**
 * ProjectManagement api controller class.
 *
 * @package Modules\ProjectManagement
 * @license OMS License 2.2
 * @link    https://jingga.app
 * @since   1.0.0
 */
final class ApiController extends Controller
{
    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiProjectCreate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
        if (!empty($val = $this->validateProjectCreate($request))) {
            $response->header->status = RequestStatusCode::R_400;
            $this->createInvalidCreateResponse($request, $response, $val);

            return;
        }

        $project = $this->createProjectFromRequest($request);
        $this->createModel($request->header->account, $project, ProjectMapper::class, 'card', $request->getOrigin());

        $this->createStandardCreateResponse($request, $response, $project);
    }

    /**
     * Method to create card from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return Project
     *
     * @since 1.0.0
     */
    public function createProjectFromRequest(RequestAbstract $request) : Project
    {
        $project                     = new Project();
        $project->name               = $request->getDataString('name') ?? '';
        $project->descriptionRaw     = $request->getDataString('plain') ?? '';
        $project->description        = Markdown::parse($request->getDataString('plain') ?? '');
        $project->start              = $request->getDataDateTime('start') ?? $project->start;
        $project->end                = $request->getDataDateTime('end') ?? $project->end;
        $project->createdBy          = new NullAccount($request->header->account);
        $project->progressType       = ProgressType::tryFromValue($request->getDataInt('progresstype')) ?? ProgressType::MANUAL;
        $project->progress           = $request->getDataInt('progress') ?? 0;
        $project->budgetCosts->value = $request->getDataInt('budgetcosts') ?? 0;
        $project->actualCosts->value = $request->getDataInt('actualcosts') ?? 0;
        $project->unit               = $request->getDataInt('unit') ?? $this->app->unitId;

        // @todo implement media path based on id
        if (!empty($request->files)) {
            $uploaded = $this->app->moduleManager->get('Media', 'Api')->uploadFiles(
                names: [],
                fileNames: [],
                files: $request->files,
                account: $request->header->account,
                basePath: __DIR__ . '/../../../Modules/Media/Files/Modules/ProjectManagement',
                virtualPath: '/Modules/ProjectManagement',
            );

            foreach ($uploaded->sources as $media) {
                $project->files[] = $media;
            }
        }

        $mediaFiles = $request->getDataJson('media');
        foreach ($mediaFiles as $media) {
            $project->files[] = new NullMedia($media);
        }

        return $project;
    }

    /**
     * Validate card create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateProjectCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['name'] = !$request->hasData('name'))) {
            return $val;
        }

        return [];
    }
}
