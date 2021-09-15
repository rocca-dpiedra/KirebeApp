<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Timelog[]|\Cake\Collection\CollectionInterface $timelogs
 */
?>

<?= $this->Html->css(['reports']) ?>

<!-- Vista de Reporte -->
<div class="row">
    <div class="column-responsive column-90">   
        <div class="timelogs index content">
            <h3><?= __('Reporte Personalizado') ?></h3>
            <p> Muestra el detalle de las sesiones filtrado por proyecto, usuario y fechas a consultar.</p>
            <div class="contenedor-formulario"> 
                <?= $this->Form->create(null,['url'=>['action'=>'repcustom']]); ?>
                <div class="formulario"> 
                    <!-- Primera columna del filtro. -->
                    <div class="contenido">
                        <label class="project-label">1- Selección de Proyecto(s). </label>
                        <div class="grupo1">
                            <div class="projects">
                                <?= $this->Form->control('projects',
                                [
                                    'value'=>$this->request->getData('projects'), 
                                    'options' => $projects, 
                                    'multiple' => 'checkbox',
                                    'label' => ''
                                ]); ?>
                            </div>                    
                        </div>
                        <div class="check1">
                            <?php echo $this->Form->control('allps', ['type' => 'checkbox','label' => ['class' => 'etiqueta', 'text' => 'Seleccionar Todos'], 'onclick'=>'allpjs(this)']); ?>
                        </div>
                    </div>
                    <!-- Segunda columna del filtro -->
                    <div class="contenido">
                        <label class="users-label">2- Selección de Usuario(s). </label>
                        <div class="grupo2">
                            <div class="users">
                                <?= $this->Form->control('users',
                                [
                                    'value'=>$this->request->getData('users'),
                                     'options' => $users,
                                      'multiple' => 'checkbox',
                                       'label' => ''
                                ]); ?>
                            </div>
                        </div>
                        <div class="check2">
                            <?php echo $this->Form->control('allus', ['type' => 'checkbox','label' => ['class' => 'etiqueta', 'text' => 'Seleccionar Todos'], 'onclick'=>'allusers(this)']); ?>
                        </div>
                    </div>
                    <!-- Tercer Columna del filtro -->
                    <div class="contenido fechas">
                        <label class="date-label">3- Seleccione Rango de Fechas.</label>
                        <div class="grupo3">
                            <div class="date1">
                                <?php echo $this->Form->label('Fecha Inicio'); ?>
                                <?= $this->Form->date('start',['label'=>'Inicio','value'=>$this->request->getData('start')]); ?>
                            </div>
                            <div class="date2">
                                <?php echo $this->Form->label('Fecha Final'); ?>
                                <?= $this->Form->date('end',['label'=>'Fin','value'=>$this->request->getData('end')]); ?>
                            </div>
                        </div>
                    </div>
                    <div class="check3">
                            <?php echo $this->Form->button('Generar Reporte', ['class' => 'etiqueta']); ?>
                        </div>
                </div>
                <?= $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>

<?= $this->Html->script(['allchecks']) ?>