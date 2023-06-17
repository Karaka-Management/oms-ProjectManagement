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

$footerView   = new \phpOMS\Views\PaginationView($this->l11nManager, $this->request, $this->response);
$footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');
$footerView->setPages(20);
$footerView->setPage(1);

$list = $this->data['projects'];

echo $this->data['nav']->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="portlet">
            <div class="portlet-head"><?= $this->getHtml('Projects'); ?><i class="lni lni-download download btn end-xs"></i></div>
            <div class="slider">
            <table class="default sticky">
                <thead>
                <tr>
                    <td class="wf-100"><?= $this->getHtml('Title'); ?>
                    <td><?= $this->getHtml('Start'); ?>
                    <td><?= $this->getHtml('Due'); ?>
                <tbody>
                <?php $count = 0; foreach ($list as $key => $value) : ++$count;
                $url         = \phpOMS\Uri\UriFactory::build('projectmanagement/profile?{?}&id=' . $value->id); ?>
                <tr tabindex="0" data-href="<?= $url; ?>">
                    <td data-label="<?= $this->getHtml('Title'); ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->name); ?></a>
                    <td data-label="<?= $this->getHtml('Start'); ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->getStart()->format('Y-m-d')); ?></a>
                    <td data-label="<?= $this->getHtml('Due'); ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->getEnd()->format('Y-m-d')); ?></a>
                <?php endforeach; ?>
                <?php if ($count === 0) : ?>
                <tr><td colspan="5" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                        <?php endif; ?>
            </table>
            </div>
        </div>
    </div>
</div>
