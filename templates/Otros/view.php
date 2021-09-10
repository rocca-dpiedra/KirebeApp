<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Timelog $timelog
 */
?>
<!-- Se Modifica para que la estructura tenga la barra lateral en todos las vistas -->
<div class="row">
    <aside class="column">
        <?=$this->Element('actions', array('type' => 'Registro', 'types' => 'Registros')); ?>
    </aside>
    <div class="column-responsive column-80">
        <div class="timelogs view content">
            <h3><?= h($timelog->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $timelog->has('user') ? $this->Html->link($timelog->user->id, ['controller' => 'Users', 'action' => 'view', $timelog->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Project') ?></th>
                    <td><?= $timelog->has('project') ? $this->Html->link($timelog->project->name, ['controller' => 'Projects', 'action' => 'view', $timelog->project->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($timelog->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date') ?></th>
                    <td><?= h($timelog->date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Starttime') ?></th>
                    <td><?= h($timelog->starttime) ?></td>
                </tr>
                <tr>
                    <th><?= __('Endtime') ?></th>
                    <td><?= h($timelog->endtime) ?></td>
                </tr>
                <tr>
                    <th><?= __('Elapsedtime') ?></th>
                    <td><?= h($timelog->elapsedtime) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($timelog->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($timelog->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $timelog->status ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
