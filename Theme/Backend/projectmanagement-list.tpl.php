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

$list = $this->data['projects'];

echo $this->data['nav']->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <section class="portlet">
            <div class="portlet-head"><?= $this->getHtml('Projects'); ?><i class="g-icon download btn end-xs">download</i></div>
            <div class="slider">
            <table class="default sticky">
                <thead>
                <tr>
                    <td><?= $this->getHtml('Progress'); ?>
                    <td class="wf-100"><?= $this->getHtml('Title'); ?>
                    <td><?= $this->getHtml('Start'); ?>
                    <td><?= $this->getHtml('Due'); ?>
                <tbody>
                <?php $count = 0;
                foreach ($list as $key => $value) : ++$count;
                    $url = \phpOMS\Uri\UriFactory::build('{/base}/projectmanagement/view?{?}&id=' . $value->id); ?>
                <tr tabindex="0" data-href="<?= $url; ?>">
                    <td data-label="<?= $this->getHtml('Progress'); ?>"><a href="<?= $url; ?>"><?= $this->data['progress'][$value->id] ?? 0; ?> %</a>
                    <td data-label="<?= $this->getHtml('Title'); ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->name); ?></a>
                    <td data-label="<?= $this->getHtml('Start'); ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->start?->format('Y-m-d')); ?></a>
                    <td data-label="<?= $this->getHtml('Due'); ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->end?->format('Y-m-d')); ?></a>
                <?php endforeach; ?>
                <?php if ($count === 0) : ?>
                <tr><td colspan="4" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                <?php endif; ?>
            </table>
            </div>
        </section>
    </div>
</div>
