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
            <h3><?= __('Reporte Detallado.') ?></h3>
            <?php if($mostrar) : ?>
                <?= $this->Html->link(__('Exportar Excel'), ['controller' => 'Timelogs', 'action' => 'erd', $init, $end],['class' => 'button float-right','id' => 'exportar']) ?>
            <?php else: ?>
                <p> Filtrado por fecha, muestra el detalle de las sesiones finalizadas, tiempos y costo por proyecto y usuario</p>
            <?php endif; ?>
            <?php if($mostrar) : ?>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th><?= $this->Paginator->sort('ID') ?></th>
                            <th><?= $this->Paginator->sort('Usuario') ?></th>
                            <th><?= $this->Paginator->sort('Proyecto') ?></th>
                            <th><?= $this->Paginator->sort('Fecha') ?></th>
                            <th><?= $this->Paginator->sort('Hora Inicio') ?></th>
                            <th><?= $this->Paginator->sort('Hora Termina') ?></th>
                            <th><?= $this->Paginator->sort('Transcurrido') ?></th>
                            <th><?= $this->Paginator->sort('Costo') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($timelogs as $timelog): ?>
                        <tr>
                            <td><?= h($timelog->id) ?></td>
                            <td><?= h($timelog->usuario) ?></td>
                            <td><?= h($timelog->proyecto) ?></td>
                            <td><?= h($timelog->date) ?></td>
                            <td><?= h($timelog->inicia) ?></td>
                            <td><?= h($timelog->termina) ?></td>
                            <td><?= h($timelog->time) ?></td>
                            <td><?= $this->Number->currency($timelog->monto,'CRC') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- Paginador Personalizado con el Element Paginator -->
            <div class="paginator">
                <?=$this->Element('paginator'); ?>
            </div>
            <?php else : ?>
                <div>
                    <p> Para visualizar el reporte debe definir el rango de fechas deseado.</p>
                </div>
            <?php endif; ?>
        </div>
        <div class="content">
        <?= $this->Form->Create(null, ['type' => 'get']); ?>
            <!-- Tercer Columna del filtro -->
            <div class="table-responsive">
                <label class="date-label">Seleccione Rango de Fechas.</label>
                <table class="tabla-form">
                    <thead>
                        <tr>
                            <th> Fecha Inicio</th>
                            <th> Fecha Final</th>
                            <th> Acciones </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> <?= $this->Form->date('start',['label'=>'Inicio','value'=>$this->request->getQuery('start')]); ?> </td>
                            <td> <?= $this->Form->date('end',['label'=>'Fin','value'=>$this->request->getQuery('end')]); ?> </td>
                            <td> <?= $this->Form->Submit('Ver Reporte'); ?> </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?= $this->Form->End(); ?>
        </div>
    </div>
</div>