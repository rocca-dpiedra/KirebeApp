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
            <h3><?= __('Catálogo de Reportes') ?></h3>
            <div class="table-responsive">
                <table class="tabla">
                    <thead>
                        <tr>
                            <th>Reporte</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> <?php echo $this->Form->label('Resumen por Proyecto: '); ?> </td>
                            <td> <p> Filtrado por fechas, muestra un resumen de las sesiones finalizadas, tiempo y costo por proyecto. </p></td>
                            <td> <?= $this->HTML->link(__('Consultar'), ['controller' => 'Timelogs', 'action' => 'projectRes'], ['class'=>'reporte'] ) ?> </td>
                        </tr>
                        <tr>
                            <td> <?php echo $this->Form->label('Resumen por Usuario: '); ?> </td>
                            <td> <p> Filtrado por fechas, muestra un resumen de las sesiones finalizadas, tiempo y costo por usuario. </p></td>
                            <td> <?= $this->HTML->link(__('Consultar'), ['controller' => 'Timelogs', 'action' => 'userRes'], ['class'=>'reporte'] ) ?>  </td>
                        </tr>
                        <tr>
                            <td> <?php echo $this->Form->label('Reporte Detallado: '); ?></td>
                            <td> <p> Filtrado por fecha, muestra el detalle de las sesiones finalizadas, tiempos y costo por proyecto y usuario</p></td>
                            <td> <?= $this->HTML->link(__('Consultar'), ['controller' => 'Timelogs', 'action' => 'projectDetail'], ['class'=>'reporte'] ) ?>  </td>
                        </tr>
                        <tr>
                            <td> <?php echo $this->Form->label('Sesiones Activas: '); ?></td>
                            <td> <p> Filtrado por fecha, muestra la lista de sesiones activas, con su hora de inicio proyecto y usuario</p></td>
                            <td> <?= $this->HTML->link(__('Consultar'), ['controller' => 'Timelogs', 'action' => 'activeList'], ['class'=>'reporte'] ) ?>  </td>
                        </tr>
                        <tr>
                            <td> <?php echo $this->Form->label('Reporte Personalizado: '); ?> </td>
                            <td> <p> Muestra el detalle de las sesiones filtrado por proyecto, usuario y fechas a consultar.</p></td>
                            <td> <?= $this->HTML->link(__('Consultar'), ['controller' => 'Timelogs', 'action' => 'repCustom'], ['class'=>'reporte'] ) ?> </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>