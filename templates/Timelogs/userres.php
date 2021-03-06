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
            <h3><?= __('Reporte resumido por Usuario.') ?></h3>
            <?php if($mostrar) : ?> 
                <?= $this->Html->link(__('Exportar Excel'), ['controller' => 'Timelogs', 'action' => 'eur', $init, $end],['class' => 'button float-right','id' => 'exportar']) ?>
            <?php else: ?>
                <span> Filtrado por fechas, muestra un resumen de las sesiones finalizadas, tiempo y costo por usuario. </span>
            <?php endif; ?>
            <?php if($mostrar) : ?> 
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th><?= $this->Paginator->sort('Usuario') ?></th>
                            <th><?= $this->Paginator->sort('Cant. Sesiones') ?></th>
                            <th><?= $this->Paginator->sort('Fecha Inicio') ?></th>
                            <th><?= $this->Paginator->sort('Fecha Fin') ?></th>
                            <th><?= $this->Paginator->sort('Tiempo (hh:mm:ss)') ?></th>
                            <th><?= $this->Paginator->sort('Costo Total ¢') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($timelogs as $timelog): ?>
                        <tr>
                            <td><?= h($timelog->nombre) ?></td>
                            <td><?= h($timelog->sesiones) ?></td>
                            <td><?= h($timelog->init) ?></td>
                            <td><?= h($timelog->end) ?></td>
                            <td><?= h($timelog->total) ?></td>
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