<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Project[]|\Cake\Collection\CollectionInterface $projects
 */
?>

<?= $this->Html->css(['grid']) ?>
<!-- Se Modifica para que la estructura tenga la barra lateral en todos las vistas -->
<div class="row">
    <div class="column-responsive column-90 contenedor">
        <div class="projects index content">
            <h3><?= __('Iniciar sesión en proyecto') ?></h3>
            <div class="contenedor-grid">
                <?php foreach ($projects as $project): ?>
                    <?php if ($project->status == 1) : ?>
                    <div class="contenido-grid">
                        <div class=contenido-imagen>
                            <div class="image-grid">
                                <?= @$this->Html->image($project->image, ['class' => 'image']) ?>
                            </div>
                            <div class="acciones">
                                <p class="etiqueta"> <?= $project->subsidiary; ?> </p>
                                <p class="accion"> <?= $project->description; ?> </p>
                            </div>
                        </div>
                        <div class="acciones2">
                            
                            <?php if($activo && $registro['project_id'] == $project -> id) : ?>
                                <label class="icon-btn"> <i class="fas fa-stop stop__icon"></i> <?= $project->name; ?> </label>
                                <?= $this->Form->postLink(__('Finalizar'), 
                                    ['action' => 'terminar', $project->id,$current_user['id'],$registro['id']], 
                                    [
                                        'confirm' => __('Desea finalizar su sesión de trabajo en el proyecto: {0}?', $project->name), 
                                        'class' => 'button float-right'
                                    ],
                                ) ?>
                            <?php else : ?>
                                <label class="icon-btn"> <i class="fas fa-play play__icon"></i>  </i> <?= $project->name; ?> </label>
                                <?= $this->Form->postLink(__('Iniciar'), 
                                    ['action' => 'iniciar', $project->id,$current_user['id']], 
                                    [
                                        'confirm' => __('Desea iniciar su sesión de trabajo en el proyecto: {0}?', $project->name), 
                                        'class' => 'btn-success button btn float-right'
                                    ],
                                ) ?>
                            <?php  endif ; ?>
                        </div>
                    </div>
                    <?php  endif ; ?>
                <?php endforeach; ?>
            </div>
        </div>

            <div class="paginator">
                <?=$this->Element('paginator'); ?>
            </div>
    </div>
</div>
