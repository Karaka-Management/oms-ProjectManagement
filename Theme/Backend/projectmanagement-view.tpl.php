<?php
/**
 * Jingga
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

$project = $this->data['project'];

echo $this->data['nav']->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <section class="box wf-100">
            <header><h1><?= $this->printHtml($project->getName()); ?></h1></header>
            <div class="inner">
                <form id="fProject" method="POST" action="<?= \phpOMS\Uri\UriFactory::build('{/api}projectmanagement?{?}&csrf={$CSRF}'); ?>">
                    <table class="layout wf-100">
                        <tbody>
                        <tr><td colspan="2"><label for="iName"><?= $this->getHtml('Name'); ?></label>
                        <tr><td colspan="2"><input type="text" id="iName" name="name" placeholder="Name" value="<?= $this->printHtml($project->getName()); ?>" required>
                        <tr><td><label for="iStart"><?= $this->getHtml('Start'); ?></label>
                            <td><label for="iEnd"><?= $this->getHtml('End'); ?></label>
                        <tr><td><input type="datetime-local" id="iStart" name="start" value="<?= $this->printHtml($project->getStart()->format('Y-m-d\TH:i:s')); ?>">
                            <td><input type="datetime-local" id="iEnd" name="end" value="<?= $this->printHtml($project->getEnd()->format('Y-m-d\TH:i:s')); ?>">
                        <tr><td colspan="2"><label for="iDescription"><?= $this->getHtml('Description'); ?></label>
                        <tr><td colspan="2"><textarea id="iDescription" name="desc"><?= $this->printHtml($project->description); ?></textarea>
                        <tr><td colspan="2"><label for="iProgressType"><?= $this->getHtml('Progress'); ?></label>
                        <tr><td><select id="iProgressType" name="progressType">
                                    <option value="<?= \Modules\ProjectManagement\Models\ProgressType::MANUAL; ?>"><?= $this->getHtml('Manual'); ?>
                                    <option value="<?= \Modules\ProjectManagement\Models\ProgressType::LINEAR; ?>"><?= $this->getHtml('Linear'); ?>
                                    <option value="<?= \Modules\ProjectManagement\Models\ProgressType::EXPONENTIAL; ?>"><?= $this->getHtml('Exponential'); ?>
                                    <option value="<?= \Modules\ProjectManagement\Models\ProgressType::LOG; ?>"><?= $this->getHtml('Log'); ?>
                                    <option value="<?= \Modules\ProjectManagement\Models\ProgressType::TASKS; ?>"><?= $this->getHtml('Tasks'); ?>
                                </select>
                            <td><input type="text" id="iProgress" name="progress" value="<?= $project->getProgress(); ?>"<?= $project->getProgressType() !== \Modules\ProjectManagement\Models\ProgressType::MANUAL ? ' disabled' : ''; ?>>
                        <tr><td><label for="iBudget"><?= $this->getHtml('Budget'); ?></label><td><label for="iActual"><?= $this->getHtml('Actual'); ?></label>
                        <tr><td><input type="text" id="iBudget" name="budget" placeholder=""><td><input type="text" id="iActual" name="actual">
                        <tr><td colspan="2"><input type="submit" value="<?= $this->getHtml('Save', '0', '0'); ?>" name="save-projectmanagement-profile">
                    </table>
                </form>
            </div>
        </section>
    </div>

    <div class="col-xs-12 col-md-6">
        <div class="box wf-100">
            <?= $this->getData('tasklist')->render($project->tasks); ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <?= $this->getData('calendar')->render($project->getCalendar()); ?>
    </div>

    <div class="col-xs-12 col-md-6">
        <?= $this->getData('medialist')->render($project->files); ?>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <section class="box wf-100">
            <header><h1>Finances</h1></header>
        </section>
    </div>
</div>