<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Project $project
 */
?>
<!-- Se Modifica para que la estructura tenga la barra lateral en todos las vistas -->
<div class="row">
    <div class="column-responsive column-90">
        <div class="projects form content">


            <?= $this->Form->create($project,['type' => 'file']) ?>


            <fieldset>
                <legend><?= __('Registro de projecto') ?></legend>
                <?php
                    echo $this->Form->control('name', ['label' => 'Nombre']);
                    echo $this->Form->control('description', ['label' => 'Descripción']);


                    echo $this->Form->control('image_file', ['type' => 'file','label' => 'Imagen']);
                    echo '<p> Para una adecuada compatibilidad escoger una imagen simétrica: Resolución Ejemplo: 1024 * 1024 </p>';

                    
                    echo $this->Form->control('department', ['label' => 'Departamento']);
                    echo $this->Form->control('user_id', ['label' => 'Encargado',
                         'options' => $users]);  
                    echo $this->Form->control('subsidiary', ['label' => 'Subsidiaria']);
                    echo $this->Form->control('price', ['label' => 'Valor']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Crear Proyecto')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
