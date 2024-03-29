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

use Modules\EventManagement\Models\ProgressType;

/** \Modules\ProjectManagement\Models\Project $project */
$project = $this->data['project'];

$isNew = $project->id === 0;

echo $this->data['nav']->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <section class="portlet">
            <form id="fProject" method="<?= $isNew ? 'PUT' : 'POST'; ?>" action="<?= \phpOMS\Uri\UriFactory::build('{/api}projectmanagement?{?}&csrf={$CSRF}'); ?>">
            <div class="portlet-head"><?= $this->getHtml('Project'); ?></div>
            <div class="portlet-body">
                <div class="form-group">
                    <label for="iId"><?= $this->getHtml('ID', '0', '0'); ?></label>
                    <input type="text" name="id" id="iId" value="<?= $project->id; ?>" disabled>
                </div>

                <div class="form-group">
                    <label for="iName"><?= $this->getHtml('Name'); ?></label>
                    <input type="text" id="iName" name="name" value="<?= $this->printHtml($project->name); ?>" required>
                </div>

                <div class="flex-line">
                    <div>
                        <div class="form-group">
                            <label for="iStart"><?= $this->getHtml('Start'); ?></label>
                            <input type="datetime-local" id="iStart" name="start" value="<?= $this->printHtml($project->start->format('Y-m-d\TH:i:s')); ?>">
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="iEnd"><?= $this->getHtml('End'); ?></label>
                            <input type="datetime-local" id="iEnd" name="end" value="<?= $this->printHtml($project->end->format('Y-m-d\TH:i:s')); ?>">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="iDescription"><?= $this->getHtml('Description'); ?></label>
                    <textarea id="iDescription" name="desc"><?= $this->printHtml($project->description); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="iProgressType"><?= $this->getHtml('Progress'); ?></label>
                    <div class="flex-line wf-100">
                        <div>
                            <select id="iProgressType" name="progressType">
                                <option value="<?= ProgressType::MANUAL; ?>"><?= $this->getHtml('Manual'); ?>
                                <option value="<?= ProgressType::LINEAR; ?>"><?= $this->getHtml('Linear'); ?>
                                <option value="<?= ProgressType::EXPONENTIAL; ?>"><?= $this->getHtml('Exponential'); ?>
                                <option value="<?= ProgressType::LOG; ?>"><?= $this->getHtml('Log'); ?>
                                <option value="<?= ProgressType::TASKS; ?>"><?= $this->getHtml('Tasks'); ?>
                            </select>
                        </div>
                        <div>
                            <input type="text" id="iProgress" name="progress" value="<?= $project->progress; ?>"<?= $project->progressType !== ProgressType::MANUAL ? ' disabled' : ''; ?>>
                        </div>
                    </div>
                </div>

                <div class="flex-line">
                    <div>
                        <div class="form-group">
                        <label for="iBudget"><?= $this->getHtml('Budget'); ?></label><td>
                            <input type="text" id="iBudget" name="budget">
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                        <label for="iActual"><?= $this->getHtml('Actual'); ?></label>
                            <input type="text" id="iActual" name="actual">
                        </div>
                    </div>
                </div>
            </div>
            <div class="portlet-foot">
                <?php if ($isNew) : ?>
                    <input id="iCreateSubmit" type="Submit" value="<?= $this->getHtml('Create', '0', '0'); ?>">
                <?php else : ?>
                    <input id="iSaveSubmit" type="Submit" value="<?= $this->getHtml('Save', '0', '0'); ?>">
                <?php endif; ?>
            </div>
            </form>
        </section>
    </div>

    <?php if (!$isNew) : ?>
    <div class="col-xs-12 col-md-6">
        <div class="box wf-100">
            <?= $this->getData('tasklist')->render($project->tasks); ?>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php if (!$isNew) : ?>
<div class="row">
    <div class="col-xs-12 col-md-6">
        <?= $this->getData('calendar')->render($project->getCalendar()); ?>
    </div>

    <div class="col-xs-12 col-md-6">
        <?= $this->getData('medialist')->render($project->files); ?>
    </div>
</div>
<?php endif; ?>
