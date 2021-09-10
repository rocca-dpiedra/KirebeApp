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
            <?= $this->Html->link(__('Exportar Excel'), ['controller' => 'Timelogs', 'action' => 'ecr', $_projs,$_us, $st, $end ],['class' => 'button float-right','id' => 'exportar']) ?>
            <h3><?= __('Reporte Personalizado') ?></h3>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th><?= $this->Paginator->sort('ID') ?></th>
                            <th><?= $this->Paginator->sort('Usuario') ?></th>
                            <th><?= $this->Paginator->sort('Proyecto') ?></th>
                            <th><?= $this->Paginator->sort('Fecha') ?></th>
                            <th><?= $this->Paginator->sort('Inicio') ?></th>
                            <th><?= $this->Paginator->sort('Termina') ?></th>
                            <th><?= $this->Paginator->sort('Transcurrido') ?></th>
                            <th><?= $this->Paginator->sort('Costo') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($timelogs as $timelog): ?>
                        <tr>
                            <td><?= $this->Number->format($timelog->id) ?></td>
                            <td><?= h($timelog->usuario) ?></td>
                            <td><?= h($timelog->proyecto) ?></td>
                            <td><?= h($timelog->date) ?></td>
                            <td><?= h($timelog->inicia) ?></td>
                            <td><?= h($timelog->termina) ?></td>
                            <td><?= h($timelog->time) ?></td>
                            <td><?= $this->Number->format($timelog->monto) ?></td>
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