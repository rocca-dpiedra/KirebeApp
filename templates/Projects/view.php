<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Project $project
 */
?>
<!-- Se Modifica para que la estructura tenga la barra lateral en todos las vistas -->
<div class="row">
    <div class="column-responsive column-90">
        <div class="projects view content">
            <h3>Detalle de Proyecto: <?= h($project->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($project->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Nombre') ?></th>
                    <td><?= h($project->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Descripción') ?></th>
                    <td><?= h($project->description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Imagen') ?></th>
                    <!-- <td><?= h($project->image) ?></td> -->
                    <td><?= @$this->Html->image($project->image, ['style' => 'max-width:150px;height:auto;']) ?></td>
                </tr>
                <tr>
                    <th><?= __('Departamento') ?></th>
                    <td><?= h($project->department) ?></td>
                </tr>
                <tr>
                    <th><?= __('Encargado') ?></th>
                    <td><?= $project->has('user') ? $this->Html->link($project->user->fullname, ['controller' => 'Users', 'action' => 'view', $project->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Subsidiaria') ?></th>
                    <td><?= h($project->subsidiary) ?></td>
                </tr>
                <tr>
                    <th><?= __('Valor') ?></th>
                    <td><?= $this->Number->format($project->price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Estado') ?></th>
                    <td><?= $project->status ? __('Activo') : __('Finalizado'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Sesiones Relacionadas') ?></h4>
                <?php if (!empty($project->timelogs)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Usuario') ?></th>
                            <th><?= __('Fecha') ?></th>
                            <th><?= __('Estado') ?></th>
                            <th><?= __('Hora Inicio') ?></th>
                            <th><?= __('Hora Cierre') ?></th>
                            <th><?= __('Transcurrido') ?></th>
                        </tr>
                        <?php foreach ($project->timelogs as $timelogs) : ?>
                        <tr>
                            <td><?= h($timelogs->id) ?></td>
                            <td><?= h($timelogs->user_id) ?></td>
                            <td><?= h($timelogs->date) ?></td>
                            <td><?= ($timelogs->status)? "Activo" : "Finalizada"; ?></td>
                            <td><?= h($timelogs->starttime) ?></td>
                            <td><?= h($timelogs->endtime) ?></td>
                            <td><?= h($timelogs->elapsedtime) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
