<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Timelog[]|\Cake\Collection\CollectionInterface $timelogs
 */
?>

<!-- Se Modifica para que la estructura tenga la barra lateral en todos las vistas -->
<div class="row">
    <div class="column-responsive column-90">
        <div class="timelogs index content">
            <h3><?= __('Lista de Sesiones Activas.') ?></h3>
            <?= $this->Html->link(__('Exportar Excel'), ['controller' => 'Timelogs', 'action' => 'eal'],['class' => 'button float-right','id' => 'exportar']) ?>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th><?= $this->Paginator->sort('id') ?></th>
                            <th><?= $this->Paginator->sort('Usuario') ?></th>
                            <th><?= $this->Paginator->sort('Proyecto') ?></th>
                            <th><?= $this->Paginator->sort('Fecha') ?></th>
                            <th><?= $this->Paginator->sort('Hora Inicio') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($timelogs as $timelog): ?>
                        <tr>
                            <td><?= $this->Number->format($timelog->id) ?></td>
                            <td><?= h($timelog->usuario) ?></td>
                            <td><?= h($timelog->proyecto) ?></td>
                            <!-- .Para Formatear Fechas. -->
                            <td><?= h($timelog->date->format('d-m-Y')) ?></td>
                            <td><?= h($timelog->inicia) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- Paginador Personalizado con el Element Paginator -->
            <div class="paginator">
                <?=$this->Element('paginator'); ?>
            </div>
        </div>
    </div>
</div>